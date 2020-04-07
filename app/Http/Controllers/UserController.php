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
use Session;
use Illuminate\Support\Facades\Hash;

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
          $new_user->user_type = 1; // 1 is service seeker; 2 is service provider;
          $new_user->password = Hash::make($data['password']);
          if($new_user->save()) {
              Auth::loginUsingId($new_user->id);
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
            $user->phone = $data->user_phone;
            if($user->save()) {
                Session::put('status' ,  'Your password updated succesfully.');
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
            $image = $request->file('file');
            $new_name = Auth::id().''.rand() .'.' .$image->getClientOriginalExtension();
            $image->move(storage_path('/public/images/profile'), $new_name);

            //find the current logged in user
            $user = User::find(Auth::id());

            //delete the previously stored file if exists
            if($user->profile_image_path != null) { 
                if(file_exists(storage_path('/public/images/profile/'.$user->profile_image_path))){
                    unlink(storage_path('/public/images/profile/'.$user->profile_image_path));
                }
            }

            $user->profile_image_path = $new_name;
            $user->save();

            return response()->json([
                'message'   => 'Image Uploaded Successfully',
                'uploaded_image' => '<img src="'.url('/').'/storage/images/profile/'.$new_name.'" class="border-white card-2" height="60" width="60" alt="User profile image display" id="trigger_image" style="border-radius:50%;"/>',
                'class_name'  => 'alert-success'
            ]);
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
