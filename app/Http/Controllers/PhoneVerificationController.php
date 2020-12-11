<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Input;
use Auth;
use Response;
use Session;
use Redirect;
use App\User;
use App\ServiceCategory;
use App\ServiceSubCategory;
use Validator;
use App\Notification;
use App\Notifications\MobileNumberVerified;

class PhoneVerificationController extends Controller
{
    public function show(Request $request)
    {
        return view('user.verification.verification-page');
    }

    public function send()
    {
      return view('user.verification.send');
    }

    public function submit()
    {
      return view('user.verification.submit');
    }


    public function requestcode(Request $request){
        $input = Input::all();
        if(Auth::user()->is_verified != 1) {
            $user = User::find(Auth::id());
            $user->phone = substr($input['target_phone_number'],1);
            $user->is_verified = 0;
            if(!app()->isLocal() || true) {
            $token = \Config::get("services.twilio.TWILIO_AUTH_TOKEN");
            $twilio_sid = \Config::get("services.twilio.TWILIO_SID");
            $twilio_verify_sid = \Config::get("services.twilio.TWILIO_VERIFY_SID");
            $twilio = new Client($twilio_sid, $token);
            $verification =  $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($input['target_phone_number'], "sms");
            $user->verification_code = $verification->sid;
            }
            $user->save();
            Session::put('status', 'Your verification code is on its way. Please check your SMS inbox.');
            return redirect()->route('user_verify_phone_submit');
        } else {
            Session::put('error', 'Account verification already completed. No action required.');
            return redirect()->back();
        }
    }

    public function verify(Request $request)
    {
        $input = Input::all();
        $validator =  Validator::make($request->all(), [
            'phone_number' => 'required',
            'verification_code' => 'required|min:4',
        ]);
        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }
        $user = User::find(Auth::id());
        $token = \Config::get("services.twilio.TWILIO_AUTH_TOKEN");
        $twilio_sid = \Config::get("services.twilio.TWILIO_SID");
        $twilio_verify_sid = \Config::get("services.twilio.TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);

       
            //if not test environment
            if(!app()->isLocal() || true) {
                try {
                    $verification = $twilio->verify->v2->services($twilio_verify_sid)
                        ->verificationChecks
                        ->create($input['verification_code'], array('to' => '+'.$input['phone_number']));
                      
                    if ($verification->valid) {
                        $user->is_verified =1;
                        $user->save();
                        //send notification
                        $this->send_mobile_number_verification_success_notification();
                        if(Session::has('mobile_number_changed')) {
                            return redirect::to(Session::pull('mobile_number_changed'));
                        }
                        if(Session::has('is_sp_registration_required')) {
                            return redirect()->route('service_provider_register_business');
                        } else {
                        return redirect()->route('service_seeker_home');
                        }
                    } else {
                        $validator->errors()->add('verification_code', 'Verification code is incorrect.');
                        return redirect()
                                ->back()
                                ->withErrors($validator)
                                ->withInput();
                    } 
                }
                catch (\Exception $e) {
                    //dd($e);
                    $validator->errors()->add('verification_code', $e->getCode(). ' : ' . $e->getMessage());
                    return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
                }
            } else { 
                $user->is_verified =1;
                $user->save();
                //send notification
                $this->send_mobile_number_verification_success_notification();
                if(Session::has('mobile_number_changed')) {
                    return redirect::to(Session::pull('mobile_number_changed'));
                }
                if(Session::has('is_sp_registration_required')) {
                    return redirect()->route('service_provider_register_business');
                } else {
                    return redirect()->route('service_seeker_registration_completed');
                }
            }
       
    }

    function send_mobile_number_verification_success_notification() {
        $user = auth()->user();
        $data = new \stdClass();
        $data->name = $user->first;
        $data->mobile_number_masked = '******'. substr($user->phone, -4);
        //email notification
        Auth::user()->notify(new MobileNumberVerified($data));
        //sms notification
        //push notification
    }
}