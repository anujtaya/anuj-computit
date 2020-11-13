<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Auth;
use Response;
use Carbon\Carbon;
use Session;
use PDF;
use App\Job;
use App\User; 
use Notifiable;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use Illuminate\Support\Facades\Log;

class AdminSystemController extends Controller
{
    public function index(){
        return view('admin_portal.modules.system.dashboard');
    }
    
    //expiry job funtions
    public function job_expiry_crone_manual(Request $request){
        //find all the jobs that are currently open.
        $jobs = Job::where('status', 'OPEN')->get();
        foreach($jobs as $job) {
            //check if the job is expired
            if(Carbon::parse($job->job_date_times)->isPast()) {
                $job->status = 'EXPIRED';
                if($job->save()) {
                    $this->send_user_mobile_notification($job->service_seeker_profile, 'Job Expired!','Your job listed under '.$job->service_category_name.' category has expired. Please revisit the job details page to repost the job with updated information.');
                    Log::channel('crone')->info('Job with id #'.$job->id.' is marked as expired.');
                }
            }
        }

        Log::channel('crone')->info('Crone job succesffuly completed by manual run by user_id='.Auth::id());
        Session::put('status', 'Crone job completed.');
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
