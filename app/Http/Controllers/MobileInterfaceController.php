<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use Input;
use Validator;
use Auth;
use App\User;
use Session;
use Image;
use Storage;
use URL;

class MobileInterfaceController extends Controller
{
    protected function test_push_notification(){
        print_r('Begin test....<br>');
        //code goes here
        print_r('End test.');
        die();
    }


    //login android user
    protected function android_login(Request $request){
        $userdata = array(
        'email' => Input::get('email') ,
        'password' => Input::get('password')
        );
        if(Auth::attempt($userdata)){
        return Response::json(Auth::id());
        } else {
        return Response::json(false);
        }
    }
}
