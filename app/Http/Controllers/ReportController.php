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
use App\UserLoginLog;

class ReportController extends Controller
{
    function all(){
        return view('admin_portal.modules.reports.all');
    }

    function user_login_analytics(){
        $logs = UserLoginLog::orderBy('last_login_date', 'DESC')->paginate(10);  

        $login_today = UserLoginLog::whereDate('last_login_date', Carbon::today())->get();
        $login_yesterday = UserLoginLog::whereDate('last_login_date', Carbon::yesterday())->get();
        $analytics = new \stdClass();
        $analytics->login_today = count($login_today);
        $analytics->login_yesterday = count($login_yesterday);


         if ( $analytics->login_today == 0 ) {
            $analytics->login_variation  = -100;
         } else {
            $analytics->login_variation = (1 - $analytics->login_yesterday /  $analytics->login_today) * 100;
         }



        return view('admin_portal.modules.reports.user_login_analytics')->with('logs', $logs)->with('analytics', $analytics);
    }


    function jobs_analytics(){
        $jobs = Job::orderBy('created_at', 'DESC')->paginate(10);  
        $jobs_total = Job::all();
        $jobs_today = Job::whereDate('created_at', Carbon::today())->get();
        $jobs_completed = Job::where('status', 'COMPLETED')->get();
        $jobs_open = Job::where('status', 'OPEN')->get();
        $analytics = new \stdClass();
        $analytics->jobs_today = count($jobs_today);
        $analytics->jobs_total = count($jobs_total);
        $analytics->jobs_open = count($jobs_open);
        $analytics->jobs_completed = count($jobs_completed);

        return view('admin_portal.modules.reports.jobs_analytics')->with('jobs', $jobs)->with('analytics', $analytics);
    }
}
