<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Auth;
use Response;
use Carbon\Carbon;
use Session;
use PDF;
use Notifiable;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Job;
use App\User; 

class PostJobCompletionController extends Controller
{
    //handle Service Seeker job completion
    protected function job_notify_completion_confirmation(Request $request){
        $input = (object) $request->all();
        $job = Job::find($input->job_id);
       
        if($job != null) {
            if($input->user_type == 'SP') {
                //send push notification to Service Provider
                if($job->sp_notified == 0) {
                    $this->send_user_mobile_notification($job->service_provider_profile, 'Success you’ve finished your job!','Go to the More Tab and finalise your Payouts section to start getting paid.');
                    $job->sp_notified = 1;
                    $job->save();
                }      
                return redirect()->route('service_provider_home');
            } else {
                //send push notification to Service Seeker
                if($job->ss_notified == 0) {
                    $this->send_user_mobile_notification($job->service_seeker_profile, 'Success!','You’ve finished your job with your Local Provider. Need more work done, Get posting today!');
                    $job->ss_notified = 1;
                    $job->save();
                }
                return redirect()->route('service_seeker_home');
            }
        }
        return redirect()->back();
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
