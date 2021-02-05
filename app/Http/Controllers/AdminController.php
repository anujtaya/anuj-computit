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
use Carbon\Carbon;
use Response;
use App\Notifications\AccountCreated;
use App\Job;
use DB;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class AdminController extends Controller
{
    function home(){
        //show home page
        return view('admin_portal.modules.home.home');
    }

    function users_all(){
        $users = User::paginate(10);
        return view('admin_portal.modules.user_management.users' , ['users' => $users]);
    }

    function users_search(Request $request) {
        $input = $request->all();
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
		$input = $request->all();
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
		$input = $request->all();
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


    //jobs module function
    //show all jobs list
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


    //show a job profile for given id
    protected function job_profile($id) {
        $job = Job::find($id);
        if($job != null) {
            return view('admin_portal.modules.jobs.job' , ['job' => $job]);
        }
        Session::put('error', 'Job with id #'.$id.' does not exists in the database.');
        return redirect()->route('app_portal_admin_jobs');
    }

    //maps module functions
    //show heatmap view without data
    protected function show_heatmap(){
        return view('admin_portal.modules.map.heatmap');
    }

    protected function show_user_track(){
        return view('admin_portal.modules.map.user_track');
    }

    //fetch heatmap data
    public function fetch_user_track_locations() {
        $user_id = $_POST['user_id'];
        $user = User::find($user_id);
        if($user != null) {
            return Response::json($user->current_location);
        }
        return Response::json(false);
    }

    //fetch heatmap data
    public function fetch_heatmap_locations() {
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        $radius = $_POST['radius'];
        if($radius < 5) {
            $radius = 5;
        }
        $d =  DB::table("users")
        ->select("users.*" ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
            * cos(radians(users.user_lat)) 
            * cos(radians(users.user_lng) - radians(" . $lng . ")) 
            + sin(radians(" .$lat. ")) 
            * sin(radians(users.user_lat))) AS distance"))
            //->where('users.is_online', true)
            ->having('distance', '<=', $radius)
            ->orderBy('distance', 'asc')
            ->get(); 
        return Response::json($d);
    }


    //user mobile notification routes
    protected function send_user_mobile_test_notification(Request $request) {
        $input = (object) $request->all();
        $user  = User::find($input->user_id); 
        $title = $input->title;
        $message = $input->body;
        if($user != null){
            if($user->push_notification_token != null) {
                //prepare notification
                $optionBuilder = new OptionsBuilder();
                $optionBuilder->setTimeToLive(60*20);
                $notificationBuilder = new PayloadNotificationBuilder($title);
                $notificationBuilder->setBody($message)->setSound('discreet');
                $option = $optionBuilder->build();
                $notification = $notificationBuilder->build();
                $downstreamResponse = FCM::sendTo($user->push_notification_token, $option, $notification);
                if(count($downstreamResponse->tokensToDelete()) > 0) {
                    $user->push_notification_token = null;
                    $user->save();
                    Session::put('error', 'Firebase alerted to delete the token. System deleted the token on demand.');
                }
                if($downstreamResponse->numberSuccess() > 0) {
                    Session::put('success', 'Mobile nottification sent successfully. Token is healthy.');
                }
                if(count($downstreamResponse->tokensToModify()) > 0) {
                    $tokens = $downstreamResponse->tokensToModify();
                    $user->push_notification_token = $tokens[0]['value'];
                    $user->save();
                    Session::put('success', 'Mobile nottification sent successfully and token is updated.');
                }
            } else {
                Session::put('error', 'User fcm token is empty.');
            }
        } else {
            Session::put('error', 'User not found.');
        }
        return redirect()->back();
    }

    //cancel job
    protected function job_cancel(Request $request) {
        $input = (object) $request->all();
        $job = Job::find($input->job_id);
        if($job != null) {
            $job->status = 'CANCELLED';
            if($job->save()){
                Session::put('success', 'Job Cancelled!');
            }  
        }
        return redirect()->back();
    }



    
}
