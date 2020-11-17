<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Job;
use App\User;
use Auth;
use Response;
use Carbon\Carbon;
use Session;
use Validator;
use PDF;
use DB;
use Notifiable;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;


class ExpiredJobController extends Controller
{
    //preapre job to be reposted
    protected function prepare_job_repost_flow($id) {
        $job = Job::find($id);
        if($job != null) {
            if($job->service_seeker_id == Auth::id()){
                return view("service_seeker.jobs..expired_job.expired_job_home")->with('job',$job);
            } 
        }
        return redirect()->back();
    }

    //set the job to open on user demand
    protected function set_expired_job_to_open(Request $request) {
        $input = (object)$request->all();
        $job = Job::find($input->job_id);
        if($job != null) {
            //display the expired job page
            if(Carbon::parse($input->job_date_time)->isPast()) {
                Session::put('expired_job_error','Job date time must be set to future.');
                return redirect()->back();
            }
            $job->job_date_time = $input->job_date_time;
            $job->title = $input->update_job_title;
            $job->description = $input->update_job_description;
            $job->status = "OPEN";
            if($job->save()){
                $this->send_user_mobile_notification($job->service_seeker_profile, 'We have successfully reposted your job to job board.','Service Provider will respond to your job with quotes soon. Visit LocaL2LocaL Job menu to see more info about the job.');
                return redirect()->route('service_seeker_job', $job->id);
            }
        }
        return redirect()->back();
    }


    //update location details

    protected function update_job_location(){
        $job_obj = json_decode($_POST['job_obj']);
        $seeker_id = Auth::user()->id;
        $response = false;
        //check whether a draft job exists for this job.
        $job = Job::where('id', $job_obj->job_id)->where('service_seeker_id', $seeker_id)->first();
          if($job != null){
            $job->street_number = $job_obj->current_address_string->street_number;
            $job->street_name = $job_obj->current_address_string->street_name;
            $job->state = $job_obj->current_address_string->state;
            $job->postcode = $job_obj->current_address_string->postcode;
            $job->city =$job_obj->current_address_string->city;
            $job->suburb = $job_obj->current_address_string->suburb;
            $job->job_lat = $job_obj->job_lat;
            $job->job_lng = $job_obj->job_lng;
            $response = $job->save();
            if($response){
                return Response::json('Location updated.');
            }
        } 
        return Response::json('Job not found or you are authrized to access the job.');     
    }

          
    //user mobile notification routes
    protected function send_user_mobile_notification($user, $title, $message) {
        $response = false;
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
                    //set the user token to empty
                }
                if($downstreamResponse->numberSuccess() > 0) {
                    $response = true;
                    //do nothing here
                }
                if(count($downstreamResponse->tokensToModify()) > 0) {
                    $tokens = $downstreamResponse->tokensToModify();
                    $user->push_notification_token = $tokens[0]['value'];
                    $user->save();
                    Session::put('success', 'Mobile nottification sent successfully and token is updated.');
                }
            } 
        } 
        return $response;
    }
}
