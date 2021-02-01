<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use Validator;
use Auth;
use App\User;
use App\UserCurrentLocation;
use Session;
use Image;
use Storage;
use URL;
use Response;
use DB;

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
        'email' => $request->get('email'),
        'password' => $request->get('password')
        );
        if(Auth::attempt($userdata)){
        return Response::json(Auth::id());
        } else {
        return Response::json(false);
        }
    }


    //save access token from ios device
    protected function save_ios_device_token(Request $request){
        $input = $request->all();
        $user = User::find($input['user_id']);
        $response = false;
        if($user != null){
            $user->push_notification_token = $input['token'];
            $user->save();
        }
    }
    //saves access token from android devices
    protected function save_android_device_token(Request $request){
        $input = $request->all();
        $user = User::find($input['id']);
        $response = false;
        if($user != null){
            $user->push_notification_token = $input['token'];
            if($user->save()) {
                $response = true;
            }
        }
        if($response) {
            return Response::json(true);
        } 
        return Response::json(false);
    }

    //save access token from iOS device



    //dump user id for iOS devices
    function dump_iOS_user_id(){
        if(Auth::check()){
            $post_data = array('user_id' => strval(Auth::id()));
            return Response::json($post_data);
        } 
        else {
            $post_data = array('user_id' => strval(0));
            return Response::json($post_data);
        }
    }


    // update the service provider co-ordinates in the database.
	public function iOS_location_receiver() {
		$lat = $_POST['latitude'];
        $lng = $_POST['longitude'];
        $response = false;
		if (Auth::user()) {
            $user = User::find(Auth::id());
            if($user != null) {
                $current_location = $user->current_location;
                if($current_location != null) {
                    $current_location->lat = $lat;
                    $current_location->lng = $lng;
                    if($current_location->save()) {
                        $user->user_lat = $lat;
                        $user->user_lng = $lng;
                        $user->save();
                        $response = true;
                    }
                } else {
                    $current_location = new UserCurrentLocation();
                    $current_location->lat = $lat;
                    $current_location->lng = $lng;
                    $current_location->user_id = $user->id;
                    if($current_location->save()) {
                        $user->user_lat = $lat;
                        $user->user_lng = $lng;
                        $user->save();
                        $response = true;
                    }
                }
            }
		} 
        if($response) {
            var_dump(http_response_code(200));
        }
		var_dump(http_response_code(403)); 
	}

    //saves access token from android devices
    protected function save_android_device_token_2(){
        $id = $_POST['id'];
		$token = $_POST['token'];
        $user = User::find($id);
        if($user != null){
            $user->push_notification_token = $token;
            $user->save();
        }
        return Response::json(true);
    }



	// ANDROID ONLY: update the service provider co-ordinates in the database.
	public function android_location_receiver() {
		$id = $_POST['id'];
		$lat = $_POST['lat'];
        $lng = $_POST['lng'];
        $user = User::find($id);
        $response = false;
        if($user != null) {
            $current_location = $user->current_location;
            if($current_location != null) {
                $current_location->lat = $lat;
                $current_location->lng = $lng;
                if($current_location->save()) {
                    $user->user_lat = $lat;
                    $user->user_lng = $lng;
                    $user->save();
                    $response = true;
                }
            } else {
                $current_location = new UserCurrentLocation();
                $current_location->lat = $lat;
                $current_location->lng = $lng;
                $current_location->user_id = $user->id;
                if($current_location->save()) {
                    $user->user_lat = $lat;
                    $user->user_lng = $lng;
                    $user->save();
                    $response = true;
                }
            }
        }
        if($response) {
            return Response::json(true);
        }
		return Response::json(false);
	}

}
