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


}
