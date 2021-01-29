<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Conversation;
use Auth;
use View;
use Response;
use App\ConversationMessage;
use App\JobPayment;
use Notification;
use App\Notifications\ServiceProviderEmailInvoice;
use App\Notifications\JobStatusUpdate;
use App\User;
use Carbon\Carbon;
use Validator;
use PDF;
use Session;
use DB;

class JobNotificationController extends Controller
{
    function send_job_status_update_notification_to_service_seeker($job){
        //sms channel
        //push notification channelgit
        //email notification
        $user = User::find($job->service_seeker_id);
        $job->service_provider_name = $user->first;
        
        $user->notify(new JobStatusUpdate($job));
    }


    function test_template() {
        $job = Job::find(2);
        $user = User::find($job->service_seeker_id);
        $job->service_provider_name = $user->first;
        $user->notify(new JobStatusUpdate($job));
        dd(true);
    }
}
