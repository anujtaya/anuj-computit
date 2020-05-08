<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Auth;
use Session;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use App\User;
use App\ServiceProviderPayment;
use App\ServiceSeekerStripePayment;
use App\ServiceSeekerStripePaymentSource;
use Carbon\Carbon;

class ServiceSeekerStripePaymentController extends Controller
{
    
    //creates a new stripe customer record and saves it into database
    function create_customer(Request $request) {
        $input = Input::all();
        //check for existing user info, if exists use the customer ref number to push the account update.
        \Stripe\Stripe::setApiKey("sk_test_nsNpXzwR8VngENyceQiFTkdX00Tdv3sLsm");
        $input = Input::all();
        $stripe_payment_record =   Auth::user()->service_seeker_stripe_payment;
        $response = false;
        if($stripe_payment_record != null){
            $response = $this->add_stripe_customer_card_object($input);
        } else {
            $response = $this->create_new_stripe_customer_object($input);
        }
  
         return redirect()->back();
               
      } 



      //add stripe customer object 
      protected function add_stripe_customer_card_object($data){
        \Stripe\Stripe::setApiKey("sk_test_nsNpXzwR8VngENyceQiFTkdX00Tdv3sLsm");
        $customer_object =  Auth::user()->service_seeker_stripe_payment;
        $card = false;
        $return_response = false;
        $customer = $this->stripe_retrive_cust($customer_object->stripe_payment_token_id);
        if($customer != null){
              $card = $this->attach_payment_source($customer, $data['stripeToken']);
        }

        if($card != null) {
             $source_obj = new ServiceSeekerStripePaymentSource();
             $source_obj->card_reference =$card->id;
             $source_obj->last_4 = $card->last4;
             $source_obj->brand =$card->brand;
             $source_obj->sss_payment_id = $customer_object->id;

             $expiry_month = $card->exp_month;
             if(strlen($expiry_month) < 2){
                 $expiry_month = '0'.$expiry_month;
             }

             $expiry_date =Carbon::parse('01/'.$expiry_month.'/'.$card->exp_year)->format('Y-m-d');
             $source_obj->expiry= $expiry_date;
             $source_obj->is_default = false;
             $return_response = $source_obj->save();
        }

        return $return_response;
   }




   //retrieve stripe customer
   protected function stripe_retrive_cust($customer_id){
      \Stripe\Stripe::setApiKey("sk_test_nsNpXzwR8VngENyceQiFTkdX00Tdv3sLsm");
      try {
      $cu = \Stripe\Customer::retrieve($customer_id);
      return $cu;
      } catch (\Stripe\Error\InvalidRequest $e) {
          Session::put('error', 'Something went wrong with your stripe account. Please contact support.');
          return null;
      }
  }


  //create new stripe customer object
  protected function create_new_stripe_customer_object($data){
    \Stripe\Stripe::setApiKey("sk_test_nsNpXzwR8VngENyceQiFTkdX00Tdv3sLsm");
    $response = false;
    $customer_response = false;
    try {
      $customer =  Customer::create([
        'email' => Auth::user()->email, //replace with the cusotm
        'source' => $data['stripeToken'],
      ]);

      if(isset($customer->id)){
          //save the payment reference to the local database
          $pay_obj = new ServiceSeekerStripePayment();
          $pay_obj->user_id = Auth::id();
          $pay_obj->stripe_payment_token_id = $customer->id;
          $pay_obj->save();

          //retirve customer sources
          $card = Customer::retrieve($customer->id)->sources->all(array("object" => "card"));

          $source_obj = new ServiceSeekerStripePaymentSource();
          $source_obj->card_reference =$card->data[0]->id;
          $source_obj->last_4 = $card->data[0]->last4;
          $source_obj->brand =$card->data[0]->brand;
          $source_obj->sss_payment_id = $pay_obj->id;

          $expiry_month = $card->data[0]->exp_month;
          if(strlen($expiry_month) < 2){
              $expiry_month = '0'.$expiry_month;
          }

          $expiry_date = Carbon::parse('01/'.$expiry_month.'/'.$card->data[0]->exp_year)->format('Y-m-d');
          $source_obj->expiry= $expiry_date;
          $source_obj->is_default = true;
          $response = $source_obj->save();
      }
    } catch (\Stripe\Error\InvalidRequest $e){Session::put('error', $e->getMessage());}
      catch (\Stripe\Error\Card $e){Session::put('error', $e->getMessage());}
      catch (\Stripe\Error\Customer $e){ Session::put('error', $e->getMessage());}
      catch (\Stripe\Error\Account $e){  Session::put('error', $e->getMessage());}

 
    return $response;
}


   //attach card to stripe customer object
   protected function attach_payment_source($customer, $stripe_token) {
      \Stripe\Stripe::setApiKey("sk_test_nsNpXzwR8VngENyceQiFTkdX00Tdv3sLsm");
      $response = null;
      try {
          $card = $customer->sources->create(array("source" => $stripe_token,));

          if(isset($card->id)){
              $response = $card;
          }

    } catch (\Stripe\Error\InvalidRequest $e){Session::put('error', $e->getMessage());}
      catch (\Stripe\Error\Card $e){Session::put('error', $e->getMessage());}
      catch (\Stripe\Error\Customer $e){ Session::put('error', $e->getMessage());}
      catch (\Stripe\Error\Account $e){  Session::put('error', $e->getMessage());}

    return $response;
  }


  //deletes a stripe customer card
  protected function delete_customer_card($id){
    \Stripe\Stripe::setApiKey("sk_test_nsNpXzwR8VngENyceQiFTkdX00Tdv3sLsm");
    $card = ServiceSeekerStripePaymentSource::find($id);
    $reutn_response = false;
    $customer = null;
    //if the card exists in local database
    if($card != null) {
        //check if the card is default
        if(!$card->is_default){
          try {
              $customer = \Stripe\Customer::retrieve(Auth::user()->service_seeker_stripe_payment->stripe_payment_token_id);
          }  catch (\Stripe\Error\InvalidRequest $e){
              Session::put('error', $e->getMessage());
          }

          //if the stripe customer exists in stripe data object
          if($customer != null) {
                try {
                  $ref = $customer->sources->retrieve($card->card_reference)->delete();
                  //check if the response include deleted key value staus is true
                  if($ref->deleted){
                      Session::put('success', 'A payment source has been deleted.');
                      $reutn_response = true;
                      $card->delete();
                  } else {
                        Session::put('error', 'Unable to delete the payment source.');
                  }
              }   catch (\Stripe\Error\InvalidRequest $e){
                    $card->delete();
                    Session::put('error', $e->getMessage());
              }
          }
            
        }else{
          Session::put('error','You cannot remove default card');
        }
    }
     return redirect()->back();
  }


  protected function change_customer_default_card(Request $request){
    //find the customer object
    //change the default payment source to the request source
    //make other sources not-default
    \Stripe\Stripe::setApiKey("sk_test_nsNpXzwR8VngENyceQiFTkdX00Tdv3sLsm");
    $input = Input::all();
    $customer = null;
    $customer_object = Auth::user()->service_seeker_stripe_payment;
    $customer = $this->stripe_retrive_cust($customer_object->stripe_payment_token_id);
    $response = false;

    if(isset($input['source_id']) && $customer != null){
        $card = ServiceSeekerStripePaymentSource::find($input['source_id']);
        if($card != null){
            if(!$card->is_default) {
              $stripe_card_object = $customer->sources->retrieve($card->card_reference);
              $customer->default_source = $stripe_card_object->id;
              $customer->save();
              $response = true;
            } else{
              Session::put('error', 'Not a default card.');
            }
        }

        if($response){
            $update_default_cards = $this->update_default_cards($customer_object);
            $card->is_default = true;
            $card->save();
            Session::put('success', 'Default payment source has been changed!');
        }

    }

    return redirect()->back();
}


  //make payment sources default to none;
  protected function update_default_cards($customer){
    $payment_sources = $customer->sss_payment_sources;

    foreach($payment_sources as $a){
        $a->is_default = false;
        $a->save();
    }
  }

}