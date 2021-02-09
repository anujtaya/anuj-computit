<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\User;
use Session;
use Image;
use Storage;
use URL;
use Notifiable;
use App\ServiceProviderPayment;
use App\ServiceProviderPayLog;
use Carbon\Carbon;
use Response;
use App\Notifications\AccountCreated;
use App\Job;
use DB;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Redirect;


class AdminBankingController extends Controller
{
     //admin banking module
     function banking_service_provider_paylog(){
        $paylogs = ServiceProviderPayLog::all();
        //dd($paylogs);
        return view('admin_portal.modules.banking.index')->with('paylogs', $paylogs);
    }

     //Admin payout page stripe metrics responder
    function stripe_account_data(){
        try { 
            \Stripe\Stripe::setApiKey(config('app.stripe_private_key'));
            $response = \Stripe\Balance::retrieve();
            return $response;
        }catch (\Stripe\Error\InvalidRequest $e){Session::put('error', $e->getMessage() ); $response = false;}
        catch (\Stripe\Error\Card $e){Session::put('error', $e->getMessage() ); $response = false;}
        catch (\Stripe\Error\Customer $e){Session::put('error', $e->getMessage() ); $response = false;}
        catch (\Stripe\Error\Account $e){Session::put('error', $e->getMessage() ); $response = false;}
    }


    function banking_service_provider_paylog_payment_transfer($id) {
        $data  = ServiceProviderPayLog::find($id);
        $response = $this->get_bank_details($data->user_id);
        if($data != null && $response != false){
            try {
                \Stripe\Stripe::setApiKey(config('app.stripe_private_key'));
                $transfer = \Stripe\Transfer::create(array(
                            "amount" => $data->total_amount * 100,
                            "currency" => "aud",
                            "destination" => $response,
                            ));
                if(isset($transfer->id)){
                    $data->status = 'PAID';
                    $data->save();
                    Session::put('status','The payment transfer was succeefull. The money will availble in users bank account from 1 to 2 days!');
                    }
            }
            catch (\Stripe\Error\InvalidRequest $e){
                print_r($e->getMessage());
                }
            catch (\Stripe\Error\Card $e){
                print_r($e->getMessage());
                }
            catch (\Stripe\Error\Customer $e){
                print_r($e->getMessage());
            }
            catch (\Stripe\Error\Account $e){
                print_r($e->getMessage());
            }
        }  else if($data == null) {
            Session::put('error','This job is already completed. No action is required by client.');
        } else {
            Session::put('error','Please add your nominated bank account.');
        }
        return Redirect::back();
    }

    function get_bank_details($id){
        $user = ServiceProviderPayment::where('user_id' , $id)->first(); 
        if($user != null) {
            return $user->stripe_account_id;
        }
        else{
            return false;
        }
   }
}

