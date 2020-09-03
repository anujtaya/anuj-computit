<?php

/*
File Author: Anuj Taya 
File Purposes: Handle user account CRUD actions
File Created: 22/03/2020 10:11AM
Author Email: tayaanuj@gmail.com
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Input;
use Validator;
use Auth;
use App\User;
use App\UserCurrentLocation;
use Illuminate\Support\Facades\Hash;
use Image;
use Storage;
use URL;
use Notifiable;
use App\Notification;
use App\Notifications\AccountCreated;
use Session;

class UserController extends Controller
{
    //register the user account
    function register_user(Request $request){
      $validator =  Validator::make($request->all(), [
          'first' => 'required|min:3|max:255',
          'last' => 'required|min:3|max:255',
          'email' => 'required|email|unique:users,email',
          'phone' => 'required',
          'password' => 'required|min:8|confirmed',
      ]);
      if ($validator->fails()) {
          return redirect()
                  ->back()
                  ->withErrors($validator)
                  ->withInput();
      } else {
          // $data =  (object) Input::all();
          $data = $request->all();
          $new_user = new User();
          $new_user->first = $data['first'];
          $new_user->last = $data['last'];
          $new_user->email = $data['email'];
          $new_user->phone = $data['phone'];
          $new_user->user_type = 2; // 2 is service seeker; 1 is service provider;
          $new_user->password = Hash::make($data['password']);
          if($new_user->save()) {
              //create an empty current locatin object
              $current_location = new UserCurrentLocation();
              $current_location->user_id = $new_user->id;
              $current_location->save();
              Auth::loginUsingId($new_user->id);
              //once the user is logged in send the user a new account created email notification
              Auth::user()->notify(new AccountCreated($new_user->first));
              return redirect()->route('service_seeker_home');
          } else {
              Session::put('error', 'Unable to process this request.');
              return Redirect::back();
          }
        }
    }

    //update the basic account detail for all user types including service seeker and service providers - Anuj 20/03/2020
    function user_update_account_details(Request $request){
        $validator =  Validator::make($request->all(), [
            'user_first_name' => 'required|min:3|max:255',
            'user_last_name' => 'required|min:3|max:255',
            'user_phone' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        } else {
            $data =  (object) Input::all();
            $user = User::find(Auth::id());
            $user->first = $data->user_first_name;
            $user->last = $data->user_last_name;
            if($data->user_phone !=  Auth::user()->phone) {
                $user->is_verified  = false;
                $user->phone = $data->user_phone;
                Session::put('mobile_number_changed' , URL::previous());
            }
           
            if(isset($data->user_job_radius)) {
                if($data->user_job_radius > 19 && $data->user_job_radius < 200) {
                    $user->work_radius = $data->user_job_radius;     
                }    
            }
            if($user->save()) {

                Session::put('status' ,  'Your account updated succesfully.');
            }
            return redirect()->back();
          }
    }

    //update the basic account detail for all user types including service seeker and service providers - Anuj 20/03/2020
    function update_account_password(Request $request){
        $validator =  Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            Session::put('current_tab', 'usersecurity');
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        } else {
            $data =  (object) Input::all();
            $user = User::find(Auth::id());
            $user->password = Hash::make($data->password);
            if($user->save()) {
                Session::put('status' ,  'Your password updated succesfully.');
            }
            $user->save();
            return redirect()->back();
          }
    }


    //upload user profile image
    function upload_user_profile_image(Request $request){
        $validation = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:100000',
           ]);
        if($validation->passes()) {
            //find the current logged in user
            $user = User::find(Auth::id());
            $old_file_delete_path = $user->profile_image_path;
            //prepate image to be stored
            $img      = $request->file('file');
            $img_ext  = $img->getClientOriginalExtension();
            $img_name = Auth::id().'-profile_image-'.time().'.'.$img_ext;
            
            
            $data = getimagesize($img);
            $width = $data[0];
            $height = $data[1];
            
            
            //apply the image adjustments
            $image_resize = Image::make($img->getRealPath());
            $image_resize->orientate();
            if($width > $height){
                $n_height = 200;
                $n_width = 200/$height * $width;
            }else{
                $n_width = 200;
                $n_height = 200/$width * $height;
            }
            $image_resize->fit(200);

            
            $filePath = '';
            $response = false;
            if(app()->isLocal()) {
                $filePath = 'user_images_testing/'.$img_name;
                $resource = $image_resize->stream()->detach();
                $response = Storage::disk('s3')->put($filePath, $resource, 'public');
                if($response) {
                    $delete_response = Storage::disk('s3')->delete($old_file_delete_path);
                }
            } else {
                $filePath = 'user_images/'.$img_name;
                $resource = $image_resize->stream()->detach();
                $response = Storage::disk('s3')->put($filePath, $resource, 'public');
                if($response) {
                    $delete_response = Storage::disk('s3')->delete($old_file_delete_path);
                }
            }

            if($response) {
                $user->profile_image_path = $filePath;
                $user->save();
                return response()->json([
                    'message'   => 'Profile Photo uploaded Successfully.',
                    'uploaded_image' => '<img src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/'.$filePath.'" class="border-white card-2" height="60" width="60" alt="User profile image display" id="trigger_image" style="border-radius:50%;"/>',
                    'class_name'  => 'alert-success'
                ]);
            }else {
                return response()->json([
                    'message'   => $validation->errors()->all(),
                    'uploaded_image' => '',
                    'class_name'  => 'alert-danger'
                ]);
            }
            
        }
        else {
        return response()->json([
            'message'   => $validation->errors()->all(),
            'uploaded_image' => '',
            'class_name'  => 'alert-danger'
        ]);
        }
    }

}
