<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Job;
use App\Bid;
use App\Conversation;
use App\ConversationMessage;
use App\UserCurrentLocation;
use App\User;
use App\BusinessInfo;
use Auth;
use Response;
use DB;
use Validator;
use Input;
use Session;

class ServiceProviderController extends Controller
{
    function home(){
		// SULTAN - HOME - SERVICE PROVIDER HOME FUNCTION
		// At the moment retrieve all jobs. But on the production version, show 10 or 15 jobs, and then when user scrolls down retrieve more jobs.
		// Also, get most recently posted jobs
		$jobs = Job::where('status', '!=', 'DRAFT')->get();
        return view('service_provider.home')->with('jobs', $jobs);
    }

    function  registration_completed(){
        return view('service_provider.registration_completed');
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
        $stats->rating_records = $rating_records;
        //save a rating in user profile
        $user = User::find($user_id);
        $user->rating = $rating_user;
        $user->save();
        return $stats;
    }

    function service_provider_profile_nested(){
        $certificates = Auth::user()->certificates;
        $languages =  Auth::user()->languages;
        $user_services = Auth::user()->service_provider_services;
        $stats = $this->calcualte_user_job_stats(Auth::id());
        //dd($stats);
        //find a way to store cached user rating
        return View::make("service_provider.profile.nested.index")
            ->with('certificates', $certificates)
            ->with('current_languages', $languages)
            ->with('user_services', $user_services)
            ->with('stats', $stats);
    }

    function service_provider_profile_edit(){

        $current_business_info = Auth::user()->business_info;
        if($current_business_info == null) {
            $current_business_info = new BusinessInfo();
            $current_business_info->user_id = Auth::id();
            $current_business_info->save();
        }
        return View::make("service_provider.profile.index")->with('current_business_info', $current_business_info);
    }


    //bussiness detail update
    function service_provider_profile_business_edit(Request $request) {
        $validator =  Validator::make($request->all(), [
            'business_abn' => 'max:11',
        ]);
        Session::put('current_tab', 'userbasic');
        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        } else {
            $data = $request->all();
            $abn_response = $this->validate_abn( $data['business_abn']);
            if( $data['business_abn'] != null && !$abn_response) {
                $validator->getMessageBag()->add('business_abn', 'The ABN is invalid.');
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $new_business_info = Auth::user()->business_info;
            if($new_business_info == null) {
                $new_business_info = new BusinessInfo();
                $new_business_info->user_id = Auth::id();
            }
            $new_business_info->business_name =  $data['business_name'];
            $new_business_info->business_email =  $data['business_email'];
            $new_business_info->abn =  $data['business_abn'];
            if(isset($data['business_gst'])) {
                $new_business_info->gst_enabled =  true;
            } else {
                $new_business_info->gst_enabled =  false;
            }
            if($new_business_info->save()){
                $user = User::find(Auth::id());
                $user->user_type = 2;
                $user->save();
            }
            return redirect()->back();
        }
    }   

    //validates abn
    public function validate_abn($abn){
        $abn = str_replace(' ', '', $abn);
        $first_digit = substr($abn, 0,1);
        $new_abn = substr($abn, 1);
        $first_digit_substract = intval($first_digit) - 1;
        $odds = [1,3,5,7,9,11,13,15,17,19];
        $weighing_total = 0;
        $weighing_total += $first_digit_substract * 10;
        for($i = 0; $i < strlen($new_abn); $i++) {
        $weighing_total +=  $new_abn[$i]  * $odds[$i];
        }
        $result = $weighing_total/89;
        if(is_float($result)){
        return false;
        }
        else {
        return true;
        }
    }

    //add service provider services preferences
    function service_provider_update_service_preferences(){
        return View::make("service_provider.profile.nested.add_services_partial");
    }

    //add service provider certificates preferences
    function service_provider_update_certificate_preferences(){
        $certificates = Auth::user()->certificates;
        return view("service_provider.profile.nested.add_certificates_partial")->with('certificates', $certificates);
    }

    //add service provider certificates preferences
    function service_provider_update_languages_preferences(){
        $languages =  Auth::user()->languages;
        return view("service_provider.profile.nested.add_languages_partial")->with('current_languages', $languages);
    }

    function service_provider_more(){
        return View::make("service_provider.more.index");
    }

    function service_provider_more_help(){
        return View::make("service_provider.more.help");
    }

    function service_provider_more_faqs(){
        return View::make("service_provider.more.faqs");
    }

    function service_provider_more_wallet(){
        
        $payment_source = Auth::user()->service_provider_payment;
        $balance = null;
        if($payment_source != null) {
            \Stripe\Stripe::setApiKey('sk_test_nsNpXzwR8VngENyceQiFTkdX00Tdv3sLsm');
            $balance =\Stripe\Balance::retrieve(
                ['stripe_account' => Auth::user()->service_provider_payment->stripe_account_id]
            );
        }  
        return View::make("service_provider.more.wallet")
                ->with('stripe_balance', $balance);
    }

    function service_provider_jobs_history(){
        $jobs = Conversation::join('jobs', 'conversations.job_id', 'jobs.id')
                                ->where('conversations.service_provider_id', Auth::id())
                                ->where('jobs.status','!=' , 'DRAFT')
                                ->where('jobs.status','!=' , 'COMPLETED')
                                ->where('jobs.status','!=' , 'CANCELLED')
                                ->get();
        
        //dd($service_provider_jobs);
        return View::make("service_provider.jobs.history")->with('jobs', $jobs);
    }


    function service_provider_jobs_full_history(){
        $service_provider_jobs = Job::where('service_provider_id', Auth::id())->where('status', '!=', 'CANCELED')->get();
        return View::make("service_provider.jobs.full_history")->with('service_provider_jobs', $service_provider_jobs);
    }


    //service provider location update
    function services_location_update(){
        $user = User::find(Auth::id());
        $user->user_lat = $_POST['lat'];
        $user->user_lng = $_POST['lng'];
        $user->user_city = $_POST['city'];
        $user->user_state = $_POST['state'];
        $user->user_suburb = $_POST['suburb'];
        $user->user_postcode = $_POST['postcode'];
        $user->user_full_address = $_POST['full_address'];
        if($user->save()){
            $current_location = $user->current_location;
            if($current_location != null) {
                $current_location->lat = $user->user_lat;
                $current_location->lng = $user->user_lng;
                $current_location->save();
            } else {
                $current_location = new UserCurrentLocation();
                $current_location->lat = $user->user_lat;
                $current_location->lng = $user->user_lng;
                $current_location->user_id = $user->id;
                $current_location->save();
            }
            return Response::json(true);
        } else {
            return Response::json(false);
        }
    }

    function services_update_availablity_status(Request $request) {
        $validator =  Validator::make($request->all(), [
            'target_status' => 'required|'
        ]);
        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        } else {
            $data =  (object) Input::all();
            $user = Auth::user();
            if($data->target_status == "online") {
                $user->is_online = true;
            } else {
                $user->is_online = false;
            }
            $user->save();
            return redirect()->back();
        }
    }


    function service_provider_update_user_bio_view(){
        return View::make("service_provider.profile.nested.update_user_bio");
    }

    function service_provider_update_user_bio_save(Request $request){
        $input = Input::all();
        $current_user = User::find(Auth::id());
        $current_user->user_bio = $input['user_bio'];
        if($current_user->save()){
            Session::put('status' , 'Your status updated.');
        }
        return redirect()->back();
    }

    
}
