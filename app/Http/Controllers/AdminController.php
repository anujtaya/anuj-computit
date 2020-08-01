<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Validator;
use Auth;
use App\User;
use Session;
use Image;
use Storage;
use URL;
use Notifiable;
use Carbon\Carbon;
use Response;
use App\Notifications\AccountCreated;
use App\Job;

class AdminController extends Controller
{
    function home(){
        return view('admin_portal.modules.home.home');
    }

    function users_all(){
        $users = User::paginate(10);
        return view('admin_portal.modules.user_management.users' , ['users' => $users]);
    }

    function users_search(Request $request) {
        $input = Input::get();
        $users = [];
        if($input['email'] != '') {
            $users = User::where('email', 'LIKE', '%'.$input['email'] .'%')->get();
        }
        if($input['user_id'] != '') {
            $users = User::where('id',  $input['user_id'])->get();
        }
        
        return view('admin_portal.modules.user_management.users' , ['users' => $users]);
    }


    function user_profile($id){
        $user = User::find($id);
        return view('admin_portal.modules.user_management.user' , ['user' => $user]);
    }



    //chart related functions
    function reg_trend_fetch(){
        $users = User::where('created_at', '!=', null)->get(); 
        $start_date  = $_POST['start_date'];
        $end_date  = $_POST['end_date'];
        $format = 'Y-m-d';
        $from = Carbon::createFromFormat($format, $start_date);
        $to = Carbon::createFromFormat($format, $end_date);
        $raw_users =  $users->whereBetween('created_at', [$from, $to])->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('d/m/Y'); // grouping by years
        });
        $objects = new \stdClass();
        $objects->data = []; 
        $running_total = 0;  
        foreach($raw_users as $s) {
            $response = new \stdClass();
            $response->date = $s[0]->created_at->format('d/m/Y D');
            $response->count = $s->count();
            $response->trend = $running_total;
            $running_total += $s->count();
            array_push($objects->data, $response);
        }
        return Response::json($objects);
    }

    //update user online offline status
	function user_update_online_status(Request $request){
		$input = Input::all();
		$user = User::findorfail($input['user_id']);
		if($user != null) {
			$user->is_online = $input['user_profile_online_status'];
			$user->save();
			Session::put('status', 'User profile is updated successfully.');
		} else {
			Session::put('error', 'Unable to find the user. User profile update is failed.');
		}
		return redirect()->back();
    }
    
    //update user online offline status
	function user_update_account_status(Request $request){
		$input = Input::all();
		$user = User::findorfail($input['user_id']);
		if($user != null) {
			$user->status = $input['user_profile_account_status'];
			$user->save();
			Session::put('status', 'User profile is updated successfully.');
		} else {
			Session::put('error', 'Unable to find the user. User profile update is failed.');
		}
		return redirect()->back();
    }
    
    //send welcome email to user
    function user_send_welcome_email($id) {
        try {
            $user = User::findOrFail($id);
            $user->notify(new AccountCreated($user->first));
            Session::put('status', 'Welcome email sent.');
        } catch (\Exception  $e) {
            Session::put('error', $e->getMessage());
        }
        return redirect()->back();
    }


    //update user profile information via admin console 
    protected function update_user_profile_info(Request $request) {
        $input = (object) $request->all();
        $validator =  Validator::make($request->all(), [
            'first' => 'required|min:3|max:255',
            'last' => 'required|min:3|max:255',
            'id' => 'required',
            'phone' => 'required',
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        } else {
            $user = User::find($input->id);
            if($user == null) {
                return redirect()->back();
            }

            $user->first = $input->first;
            $user->last = $input->last;
            $user->phone = $input->phone;
            $user->work_radius = $input->work_radius;
            $user->car_rego = $input->car_rego;
            $user->save();
            Session::put('status', 'User profile information updated.');
            return redirect()->back();
        }
    }


    //jobs function
    function jobs_all(){
        $jobs = Job::paginate(10);
        return view('admin_portal.modules.jobs.jobs' , ['jobs' => $jobs]);
    }

    //jobs search with id
    function jobs_search(Request $request) {
        $input = $request->all();
        $jobs = [];
        if($input['search_job_id'] != '') {
            $jobs = Job::where('id',  $input['search_job_id'])->get();
        }
        
        return view('admin_portal.modules.jobs.jobs' , ['jobs' => $jobs]);
    }
    
}
