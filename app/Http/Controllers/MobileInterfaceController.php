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


    //saves access token from android devices
    protected function save_android_device_token(Request $request){
        $input = Input::all();
        $user = User::find($input['id']);
        if($user != null){
            $user->push_notification_token = $input['token'];
            $user->save();
        }
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
		if (Auth::user()) {
			DB::table('user_current_locations')->where('user_id', Auth::id())->update(['lat' => $lat, 'lng' => $lng]); //can be used along with user model behaviour.
			var_dump(http_response_code(200));
		} else {
			var_dump(http_response_code(403)); 
		}
	}

	// ANDROID ONLY: update the service provider co-ordinates in the database.
	public function android_location_receiver() {
		$id = $_POST['id'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		DB::table('user_current_locations')->where('user_id', $id)->update(['lat' => $lat, 'lng' => $lng]);
		return Response::json(true);
	}

}
