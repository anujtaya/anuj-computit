<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\User;
use App\ServiceSubCategory;
use App\ServiceCategory;
use App\Job;
use App\Rating;
use App\Conversation;
use Carbon\Carbon;
use DB;
use Response;
use Auth;
use Validator;
use Session;

class ServiceSeekerController extends Controller
{
  function registration_completed(){
    return View::make("service_seeker.registration_completed");
  }
  
  function service_seeker_home(Request $request){
      if($request->has('showBooking')){
        $categories = ServiceCategory::where('is_active', true)->get();
        return view("service_seeker.service_seeker_home_2")->with('categories', $categories);
      } else {
        $categories = ServiceCategory::all();
        $jobs = Job::where('service_seeker_id', Auth::id())->whereIn('status', ['OPEN', 'INPROGRESS', 'STARTED', 'ARRIVED', 'ONTRIP'])->get();
        $unpaid_jobs = Job::select('jobs.*', 'job_payments.payable_job_price as amount_due')
                      ->join('job_payments', 'jobs.id', '=', 'job_payments.job_id')
                      ->where('jobs.service_seeker_id', Auth::id())->whereIn('jobs.status', ['COMPLETED'])
                      ->where('job_payments.status', 'UNPAID')
                      ->get();
        //dd($unpaid_jobs);
        return view("service_seeker.service_seeker_home_1")
              ->with('categories', $categories)
              ->with('jobs', $jobs)
              ->with('unpaid_jobs', $unpaid_jobs);
      }
    
  }

  function service_seeker_profile(){
      return View::make("service_seeker.profile.index");
  }

  function service_seeker_more(){
    return View::make("service_seeker.more.index");
  }

  function service_seeker_more_help(){
      return View::make("service_seeker.more.help");
  }

  function service_seeker_more_faqs(){
      return View::make("service_seeker.more.faqs");
  }

  function service_seeker_more_wallet(Request $request){
      return View::make("service_seeker.more.wallet");
  }

  function service_seeker_messages(){

    $messages = Db::table('users')
                ->select('users.first as first',
                'users.last as last',
                'conversations.json as messages',
                'conversations.service_provider_id as service_provider_id',
                'conversations.id as conversation_id',
                'jobs.id as job_id')
                ->join('conversations', 'conversations.service_provider_id', '=', 'users.id')
                ->join('jobs', 'jobs.id', 'conversations.job_id')
                ->where('jobs.service_seeker_id', Auth::id())
                ->get();
    if(count($messages)){
      foreach($messages as $msg){
        $msg->messages = json_decode($msg->messages);
      }
    }

    return View::make('service_seeker.messages.index')->with('messages', $messages);
  }

  

    protected function fetch_service_sub_categories(){
        $response = false;
        $service_cat_id = $_POST['service_cat_id'];
        if($service_cat_id != null){
          $response = ServiceSubCategory::where('service_cat_id', $service_cat_id)->get();
        }
        return Response::json($response);
    }

    protected function update_preferences(){
        $user_preferences = json_decode($_POST['user_preferences']);
        $user = User::find(Auth::user()->id);
        $user->properties = $user_preferences;
        $response = $user->save();
        return Response::json($response);
      }

    protected function services_filter(){
      $search = $_POST['search'];

      $services = ServiceCategory::where('service_name', 'LIKE', '%'.$search.'%')->where('is_active', true)->get();

      return Response::json($services);
    }

    protected function service_seeker_job_details_update(Request $request){
      $input = $request->all();
      Session::put('current_tab', 'jobdetail');
      $validation = Validator::make($request->all(), [
        'update_job_id' => 'required',
        'update_job_title' => 'required'
       ]);
       if($validation->passes()){
         $job = Job::find($input['update_job_id']);
          if($job != NULL){
            if($job->service_seeker_id == Auth::id() && $job->status == 'OPEN'){
              
              $carbon_date = Carbon::createFromFormat('h:i A d/m/Y', $input['update_job_datetime']);
              $job->title = $input['update_job_title'];
              $job->description = $input['update_job_description'];
              
              Session::put('status', 'The job info has been successfully updated.');
              if($carbon_date->isPast()) {
                Session::put('status','Job date time must be set to future.');
                $job->save();
                return redirect()->back(); 
              } else {
                $job->job_date_time = $carbon_date->toDateTimeString();
                $job->save();
              }
            }
          }
       }
   
      return redirect()->back();
    }


    protected function service_seeker_job_location_update(Request $request){
      $input = $request->all();
      $validation = Validator::make($request->all(), [
        'update_location_job_id' => 'required',
        'json_location_object' => 'required'
       ]);
       if($validation->passes()){
         $job = Job::find($input['update_location_job_id']);
         if($job){
           if($job->service_seeker_id == Auth::id() && $job->status == 'OPEN'){
             $location = json_decode($input['json_location_object']);
             $job->street_number = $location->street_number;
             $job->street_name = $location->street_name;
             $job->state = $location->state;
             $job->postcode = $location->postcode;
             $job->city = $location->city;
             $job->suburb = $location->suburb;
             $job->job_lat = $location->lat;
             $job->job_lng = $location->lng;
             $job->save();
            Session::put('status', 'The job location has been successfully updated.');
           }
         }
       }
      Session::put('current_tab', 'jobdetail');
      return redirect()->back();
    }

    protected function service_seeker_job_location_update_pickup(Request $request){
      $input = $request->all();
      $validation = Validator::make($request->all(), [
        'update_location_pickup_job_id' => 'required',
        'json_location_object_pickup' => 'required'
       ]);
       if($validation->passes()){
         $job = Job::find($input['update_location_pickup_job_id']);
         if($job){
           if($job->service_seeker_id == Auth::id() && $job->status == 'OPEN'){
             $location = json_decode($input['json_location_object_pickup']);
             $job->street_number_pickup = $location->street_number;
             $job->street_name_pickup = $location->street_name;
             $job->state_pickup = $location->state;
             $job->postcode_pickup = $location->postcode;
             $job->city_pickup = $location->city;
             $job->suburb_pickup = $location->suburb;
             $job->job_lat_pickup = $location->lat;
             $job->job_lng_pickup = $location->lng;
             $job->save();
            Session::put('status', 'The job location has been successfully updated.');
           }
         }
       }
      Session::put('current_tab', 'jobdetail');
      return redirect()->back();
    }

    protected function service_seeker_job_location_update_dropoff(Request $request){
      $input = $request->all();
      $validation = Validator::make($request->all(), [
        'update_location_dropoff_job_id' => 'required',
        'json_location_object_dropoff' => 'required'
       ]);
       if($validation->passes()){
         $job = Job::find($input['update_location_dropoff_job_id']);
         if($job){
           if($job->service_seeker_id == Auth::id() && $job->status == 'OPEN'){
             $location = json_decode($input['json_location_object_dropoff']);
             $job->street_number_dropoff = $location->street_number;
             $job->street_name_dropoff = $location->street_name;
             $job->state_dropoff = $location->state;
             $job->postcode_dropoff = $location->postcode;
             $job->city_dropoff = $location->city;
             $job->suburb_dropoff = $location->suburb;
             $job->job_lat_dropoff = $location->lat;
             $job->job_lng_dropoff = $location->lng;
             $job->save();
            Session::put('status', 'The job location has been successfully updated.');
           }
         }
       }
      Session::put('current_tab', 'jobdetail');
      return redirect()->back();
    }


    protected function show_message_offer(){
      $conversation_id = $_POST['conversation_id'];
      $data = array();
      if($conversation_id != null){
        $converstation = Conversation::find($conversation_id);
        $service_provider = User::find($converstation->service_provider_id);
      }else{
        abort(404);
      }

      $data['conversation'] = $converstation;
      $data['service_provider'] = $service_provider;


      return Response::json(json_encode($data));
    }

    function service_seeker_jobs_full_history(){
      $service_seeker_jobs = Job::where('service_seeker_id', Auth::id())
                              ->where('status','!=' , 'DRAFT')
                              ->where('status','!=' , 'OPEN')
                              ->orderby('job_date_time', 'asc')
                              ->get();
      return View::make("service_seeker.jobs.full_history")->with('service_seeker_jobs', $service_seeker_jobs);
    }

    function services_location_update(){
      $user = User::find(Auth::id());
        $user->user_lat = $_POST['lat'];
        $user->user_lng = $_POST['lng'];
        $user->user_city = $_POST['suburb'];
        $user->user_state = $_POST['state'];
        $user->user_full_address = $_POST['full_address'];
        if($user->save()){
            return Response::json(true);
        } else {
            return Response::json(false);
        }
    }
}
