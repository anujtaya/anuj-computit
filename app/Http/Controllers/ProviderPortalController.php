<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Job;
use App\Conversation;
use Stripe;
use DB;
use Auth;
use PDF;

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

    protected function display_banking(Request $request){    
        if($request->has('full_stripe_info'))  {
            $payment_source = Auth::user()->service_provider_payment;
            if($payment_source != null) {
                \Stripe\Stripe::setApiKey('sk_test_nsNpXzwR8VngENyceQiFTkdX00Tdv3sLsm');
                $account = $this->fetch_account($payment_source->stripe_account_id);
                $balance = $this->fetch_balance($payment_source->stripe_account_id);
                //dd($balance->available[0]->amount);
                return view('provider_portal.pages.banking')
                    ->with('stripe_balance', $balance)
                    ->with('stripe_record', $account);
            }
        }     
        return view('provider_portal.pages.banking');
    }

    protected function redirect_to_banking_page(){
        return redirect()->route('app_portal_provider_banking');
    }


    protected function fetch_account($account_id){
        $response = \Stripe\Account::retrieve(
            $account_id
        );
        return $response;
    }

    protected function fetch_balance($account_id){
        $response =\Stripe\Balance::retrieve(
            ['stripe_account' => $account_id]
        );
        return $response;
    }

    //invoices function routes 
    protected function display_invoices(){
        $jobs = Job::where('status', 'COMPLETED')->where('service_provider_id', Auth::id())->get();
        return view('provider_portal.pages.invoices')
                ->with('jobs', $jobs);
    }

    protected function download_invoice($id) {
        $job = Job::find($id);
        if($job != null) {
            if($job->service_provider_id == Auth::id()) {
                $job_extras = $job->extras->where('status', 'ACTIVE');
                $conversation = Conversation::where('job_id', $job->id)
                          ->select('users.*', 'conversations.id as conversation_id', 'conversations.json', 'conversations.job_id', 'conversations.service_provider_id' )
                          ->join('users', 'conversations.service_provider_id', '=', 'users.id')
                          ->first();
                $pdf = PDF::loadView('invoice.sp_invoice_template' , array('job_id' => $id));
                return $pdf->download('invoice_jb_'.$job->id.'.pdf');
            } else {
                abort(403, 'You do not have access this resource. Please contact website administrator.');
            }
        } else {
            abort(404);
        }
    }  
}
