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


class ExpiredJobController extends Controller
{
    //preapre job to be reposted
    protected function prepare_job_repost_flow(Request $request) {
        $input = (object)$request->all();
        $job = Job::find($input->job_id);
        if($job != null) {
            //display the expired job page
            $job->job_date_time = Carbon::now()->addDays(3);
            $job->status = "OPEN";
            if($job->save()){
                $this->send_user_mobile_notification($job->service_seeker_profile, 'We have successfully reposted your job to job board.','Service Provider will respond to your job with quotes soon. Visit LocaL2LocaL Job menu to see more info about the job.');
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
