<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Job;
use DB;
use Auth;

class ProviderPortalController extends Controller
{
    protected function display_home(){
        $stats = $this->calcualte_user_job_stats(Auth::id());
        return view('provider_portal.pages.home')
        ->with('stats', $stats);
    }

    //calcualte job stats for service provider. Also exists in Service Seeker Job Controller
    function calcualte_user_job_stats($user_id){
        $completed_jobs = Job::where('service_provider_id', $user_id)
            ->orwhere('status','=' , 'COMPLETED')
            ->take(200)
            ->get();
        $cancelled_jobs = count(DB::table('service_provider_job_cancellations')->take(200)->get());
        $completed_jobs_count = count($completed_jobs->where('status', 'COMPLETED' ));
        $total_jobs = $cancelled_jobs + $completed_jobs_count;
        $percentage = 0;
        if($completed_jobs_count > 0) {
            $percentage =  ($completed_jobs_count   / $total_jobs)  * 100;
        }
        $rating_records = $completed_jobs->where('service_seeker_rating' , '!=', null)->where('status', 'COMPLETED');
        $rating_prefix = 5;
        $rating_count = 1 + count($rating_records);
        $rating_sum = intval($rating_records->sum('service_seeker_rating'));
        $rating_prefix += $rating_sum;
        $rating_user = number_format((float)$rating_prefix / $rating_count, 2, '.', '');
      
        $stats = new \stdClass();
        $stats->percentage = $percentage;
        $stats->rating = $rating_user;
        //save a rating in user profile
        $user = User::find($user_id);
        $user->rating = $rating_user;
        $user->save();
        return $stats;
    }

}
