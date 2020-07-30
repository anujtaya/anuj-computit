<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Job;
use App\Bid;
use App\Conversation;
use App\ConversationMessage;
use App\User;
use Auth;
use Response;
use Carbon\Carbon;
use Session;
use Validator;
use Input;
use App\Notifications\ServiceSeekerEmailInvoice;
use PDF;
use DB;
use Notifiable;
use App\Notification;
use App\Notifications\JobBoardNotification;
use App\Notifications\JobConversationNewMessageServiceSeeker;
use App\Notifications\JobQuoteOfferRejected;
use App\Notifications\JobQuoteOfferAccepted;
use App\ServiceseekerStripePaymentSource;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use App\ServiceProviderPaylog;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use App\JobPayment;



class JobPaymentController extends Controller
{


    function process_job_payment(Request $request){
        $input = (object) $request->all();
        $job = Job::find($input->payment_job_id);

        if($job != null ) {
            //ensure the authenticated service seeker can pay for the job and service seeker user id matches with the service seeker id stored in job.
            if($job->service_seeker_id == Auth::id()) {
                //get the payment method for balde nested view display. 
                $payment_method = $input->payment_mode;
                return view('service_seeker.jobs.partial.job_payment_process')->with('job', $job)->with('payment_method', $payment_method);
            }
        }

        //return back to the job page if the validation fails.
        return redirect()->back();
    }


    //pay for job using service seeker default stripe card source
    function process_stripe_job_payment(Request $request){
        $input = (object) $request->all();
        $job = Job::find($input->stripe_payment_job_id);

        if($job != null ) {

            //find stripe customer object for service seeker
            $stripe_payment_source = Auth::user()->service_seeker_stripe_payment;
            $payment_source = $job->job_payments;

            if($payment_source != null || $stripe_payment_source != null) {

                $payable_job_final_value = $payment_source->job_price;
                //try charging the money via stripe
                $response = $this->stripe_make_new_charge($payment_source, $payable_job_final_value, $job, $stripe_payment_source);

                if($response == true) {
                    $service_provider = $job->service_provider_profile;
                    $this->generate_service_provider_payment_record($service_provider,$payment_source,$job);
                    return redirect()->route('service_seeker_job', $job->id);
                }

            } 

        }

        //return back to the job page if the validation fails.
        return redirect()->back();
    }


    //stripe make charge request
    protected function stripe_make_new_charge($payment_source,$payable_job_final_value,$job,$stripe_payment_customer_object){
		$response = false;
		try {
			\Stripe\Stripe::setApiKey("sk_test_nsNpXzwR8VngENyceQiFTkdX00Tdv3sLsm");
			$charge_response = \Stripe\Charge::create ( array (
						"amount" => $payable_job_final_value * 100,
						"currency" => "aud",
						"customer" => $stripe_payment_customer_object->stripe_payment_token_id,
						"description" => $job->id. '--'. $job->title,
						'receipt_email' => $job->service_seeker_profile->email,
						"capture" => true,
				) );
			  if($charge_response->id != '') {
				//record payment details
				$payment_source->payment_reference_number =  $charge_response->id;
				$payment_source->payment_method = 'STRIPE';
				$payment_source->payable_job_price = $payable_job_final_value;
				$payment_source->notes = 'FINAL PAYMENT CHARGED BY LOCAL2LOCAL';
				$payment_source->status = 'PAID';
				$payment_source->save();
				$response = true;
			  }
		   }catch (\Stripe\Error\InvalidRequest $e){$response =  $e->getMessage();}
		   catch (\Stripe\Error\Card $e){$response =  $e->getMessage();}
		   catch (\Stripe\Error\Refund $e){$response =  $e->getMessage();}
		   catch (\Stripe\Error\Customer $e){$response =  $e->getMessage();}
		   catch (\Stripe\Error\Account $e){$response =  $e->getMessage();}
		   return $response;
    }
    

    //generate a payment to be paid log for service provider
	protected function generate_service_provider_payment_record($service_provider,$payment_source,$job) {
		$paylog = $job->job_paylog;
		if($paylog == null) {
			$paylog = new ServiceProviderPaylog();
			$paylog->job_id =  $job->id;
			$paylog->status = 'PENDING';
			$paylog->total_amount = $payment_source->service_provider_gets;
			$paylog->user_id = $service_provider->id;
			$paylog->save();
			//Log::info('Service Provider with id '.$service_provider->id.' paylog created for job'.$job->id);
		}
    }
    



    //paypal related functions
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }


    public function payWithpaypal(Request $request)
    {
        $input = (object) $request->all();

        $job = Job::find($input->paypal_payment_job_id);
        $payment_source = $job->job_payments;
        if($job == null) {
            return redirect()->back();
        }

        if($job->service_seeker_id != Auth::id()) {
            return redirect()->back();
        }

      
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Payment for job with id #'.$job->id.' .'.$job->title) /** item name **/
            ->setCurrency('AUD')
            ->setQuantity(1)
            ->setPrice($payment_source->job_price); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('AUD')
            ->setTotal($payment_source->job_price);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Payment at LocaL2LocaL for Service Request made by buyer.');




        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('service_seeker_process_job_payment_pay_with_paypal_status')) /** Specify return URL **/
            ->setCancelUrl(route('service_seeker_process_job_payment_pay_with_paypal_status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
       // dd(route('service_seeker_process_job_payment').'?payment_job_id='.$job->id.'&payment_mode=PAYPAL');
       // die();
        try {
            $payment->create($this->_api_context);
        }catch (\Exception $ex) {

            print_r($ex);

        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('paypal_payment_fallback_url', route('service_seeker_process_job_payment').'?payment_job_id='.$job->id.'&payment_mode=PAYPAL');
        Session::put('paypal_payment_source_id', $payment_source->id);
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');
    }
    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        $user_redirect_url =  Session::get('paypal_payment_fallback_url');
        $payment_source_id =  Session::get('paypal_payment_source_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        Session::forget('paypal_payment_fallback_url');
        Session::forget('paypal_payment_source_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::to($user_redirect_url);
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {

            /* Save order in database */
            $payment_source = JobPayment::find($payment_source_id);
            if($payment_source != null) {
                $payment_source->payment_reference_number =  $payment_id;
                $payment_source->payment_method = 'PAYPAL';
                $payment_source->notes = 'FINAL PAYMENT CHARGED BY LOCAL2LOCAL';
                $payment_source->status = 'PAID';
                $payment_source->save();
            }

            \Session::put('success', 'Payment success');
            return Redirect::to($user_redirect_url);
        }
        \Session::put('error', 'Payment failed');
        return Redirect::to($user_redirect_url);
    }


}