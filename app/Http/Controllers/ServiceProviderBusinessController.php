<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\BusinessInfo;
use Session;
use Auth;
use View;
use Input;
use Validator;

class ServiceProviderBusinessController extends Controller
{
    function registration_page(){
        $current_business_info = Auth::user()->business_info;
        return view('service_provider.business.registration_page')->with('current_business_info', $current_business_info);
    }

    function registration_process(Request $request){
        $validator =  Validator::make($request->all(), [
            'business_abn' => 'max:11',
        ]);
        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        } else {
            $data = $request->all();
            $abn_response = $this->validate_abn( $data['business_abn']);
            if( $data['business_abn'] != null && !$abn_response) {
                $validator->getMessageBag()->add('business_abn', 'The ABN is invalid.');
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $new_business_info = Auth::user()->business_info;
            if($new_business_info == null) {
                $new_business_info = new BusinessInfo();
                $new_business_info->user_id = Auth::id();
            }
            $new_business_info->business_name =  $data['business_name'];
            $new_business_info->business_email =  $data['business_email'];
            $new_business_info->abn =  $data['business_abn'];
            if(isset($data['business_gst'])) {
                $new_business_info->gst_enabled =  true;
            } else {
                $new_business_info->gst_enabled =  false;
            }
            if($new_business_info->save()){
              $user = User::find(Auth::id());
              $user->user_type = 1;
              if($user->save()) {
                return redirect()->route('service_provider_register_services');
              }
            }
            return redirect()->back();
        }
    }

    function service_registration_page(){
        $user = User::find(Auth::id());
        $user->user_type = 1;
        $user->save();
        return view('service_provider.business.service_registration_page');
    }


    public function validate_abn($abn){
        $abn = str_replace(' ', '', $abn);
        $first_digit = substr($abn, 0,1);
        $new_abn = substr($abn, 1);
        $first_digit_substract = intval($first_digit) - 1;
        $odds = [1,3,5,7,9,11,13,15,17,19];
        $weighing_total = 0;
        $weighing_total += $first_digit_substract * 10;
        for($i = 0; $i < strlen($new_abn); $i++) {
        $weighing_total +=  $new_abn[$i]  * $odds[$i];
        }
        $result = $weighing_total/89;
        if(is_float($result)){
        return false;
        }
        else {
        return true;
        }
    }
}
