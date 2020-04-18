<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Auth;
use Session;
use Stripe;
use App\User;
use App\ServiceProviderPayment;

class StripeConnectController extends Controller
{
    protected function store_stripe_connect_account(Request $request) {
        //Access the connected account id in the response
        if(Auth::user()->service_provider_payment == null) {
            $input = Input::all();
            
            try {
                \Stripe\Stripe::setApiKey('sk_test_nsNpXzwR8VngENyceQiFTkdX00Tdv3sLsm');
                $response = \Stripe\OAuth::token([
                    'grant_type' => 'authorization_code',
                    'code' => $input['code'],
                ]);
                $connected_account_id = $response->stripe_user_id;
                $new_account = new ServiceProviderPayment();
                $new_account->stripe_account_id =  $connected_account_id;
                $new_account->account_status =  'NA';
                $new_account->notes = 'New Account Created';
                $new_account->user_id = Auth::id();
                $new_account->save();
                Session::put('banking_alert', 'You have succesfully connected your Stripe account with your LocaL2LocaL account.');
          } catch (Stripe_InvalidRequestError $e) {
            Session::put('banking_alert', $e->getMessage());
            // Invalid parameters were supplied to Stripe's API
          } catch (Stripe_AuthenticationError $e) {
            Session::put('banking_alert', $e->getMessage());
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
          } catch (Stripe_ApiConnectionError $e) {
            Session::put('banking_alert', $e->getMessage());
            // Network communication with Stripe failed
          } catch (Stripe_Error $e) {
            Session::put('banking_alert', $e->getMessage());
            // Display a very generic error to the user, and maybe send
            // yourself an email
          } catch (Exception $e) {
            Session::put('banking_alert', $e->getMessage());
            // Something else happened, completely unrelated to Stripe
          }
           
         
        } else {
            Session::put('banking_alert', 'Your account already exists on LocaL2LocaL platform.');
        }
        return redirect()->route('app_portal_provider_banking');
    }


    protected function single_sign_on_link(){
      $payment_source = Auth::user()->service_provider_payment;
      if($payment_source != null) {
          \Stripe\Stripe::setApiKey('sk_test_nsNpXzwR8VngENyceQiFTkdX00Tdv3sLsm');
          $response =  \Stripe\Account::createLoginLink(
              $payment_source->stripe_account_id
              );
         return redirect()->intended($response->url);
      } else {
          print('An error occured. Sorry for the trouble.');
      }
    }


}
