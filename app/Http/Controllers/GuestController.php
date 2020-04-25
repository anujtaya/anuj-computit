<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\User;
use App\ServiceCategory;
use App\SessionDraftJob;
use App\SessionDraftJobAttachment;
use Auth;
use Session;
use Response;

class GuestController extends Controller
{

    //display the application landing page
    protected function mobile_landing_page(){
      return view('auth.mobile.getting_started');
    }

    
    //redirect user based on auth status
    protected function handle_landing_request(){
      if(Auth::check()){
        return redirect()->route('login');
      } else{
        return redirect()->route('guest_mobile_landing_page');
      }
    }


    //handle request based on user selection of seeker demo or provider demo accounts
    protected function handle_guest_register_request(Request $request){
      $input = $request->all()['demo_type'];
      //dd($input);
      if($input == 'sp'){
        return View::make("service_provider.demo.tutorial");
      } else{
        return View::make("service_seeker.demo.tutorial");
      }
    }


    //service seeker home page query handler
    protected function service_seeker_home(Request $request) {
      $categories = ServiceCategory::all();
      $session_draft_job = SessionDraftJob::where('id', Session::getID())->first();
      if($request->has('showBooking')){
        //if the request has show booking paramenter than display the job booking page.
        return view("service_seeker.demo.home_2")->with('categories', $categories)->with('session_draft_job', $session_draft_job);
      } else {
        //show the default guest homepage for service seeker.
        $service_categories = $categories->pluck('service_name');
        return view("service_seeker.demo.home_1")->with('categories', $service_categories)->with('session_draft_job', $session_draft_job);
      }
    }

    
    //create session draft job
    protected function create_draft_job(Request $request){
      $payload = json_decode($_POST['payload']);
      //fecth the session draft if exists
      $session_draft_job = SessionDraftJob::where('id', $payload->session_id)->first();
      //check if the session draft job is empty if not update the job content
      if($session_draft_job != null) {
          $session_draft_job->title = $payload->title;
          $session_draft_job->status = $payload->status;
          $session_draft_job->description = $payload->description;
          $session_draft_job->service_category_id = $payload->service_category_id;
          $session_draft_job->service_subcategory_id = $payload->service_subcategory_id;
          $session_draft_job->ip_address = $request->ip();
          $session_draft_job->user_agent = $request->server('HTTP_USER_AGENT');
          $session_draft_job->job_date_time = $payload->job_date_time;
          //guest service seeker address
          if(isset($payload->current_address_string[0])) {
              $session_draft_job->street_number = $payload->current_address_string[0]->long_name;
              $session_draft_job->street_name = $payload->current_address_string[1]->long_name;
              $session_draft_job->state = $payload->current_address_string[4]->long_name;
              $session_draft_job->postcode = $payload->current_address_string[6]->long_name;
              $session_draft_job->city = $payload->current_address_string[3]->long_name;
              $session_draft_job->suburb = $payload->current_address_string[2]->long_name;
              $session_draft_job->job_lat = $payload->job_lat;
              $session_draft_job->job_lng = $payload->job_lng;
          }  
          $session_draft_job->service_category_id = $payload->service_category_id;
          $session_draft_job->service_category_name = $payload->service_category_name;
          $session_draft_job->service_subcategory_name = $payload->service_subcategory_name;
          $session_draft_job->service_subcategory_id = $payload->service_subcategory_id;
          if($session_draft_job->save()) {
            return Response::json($session_draft_job);
          }
      } else {
          //create new session draft job if does not exists
          $session_draft_job = new SessionDraftJob();
          $session_draft_job->id = $payload->session_id;
          $session_draft_job->title = $payload->title;
          $session_draft_job->status = $payload->status;
          $session_draft_job->description = $payload->description;
          $session_draft_job->service_category_id = $payload->service_category_id;
          $session_draft_job->service_subcategory_id = $payload->service_subcategory_id;
          $session_draft_job->ip_address = $request->ip();
          $session_draft_job->user_agent = $request->server('HTTP_USER_AGENT');
          $session_draft_job->job_date_time = $payload->job_date_time;
          //guest service seeker address
          if(isset($payload->current_address_string[0])) {
              $session_draft_job->street_number = $payload->current_address_string[0]->long_name;
              $session_draft_job->street_name = $payload->current_address_string[1]->long_name;
              $session_draft_job->state = $payload->current_address_string[4]->long_name;
              $session_draft_job->postcode = $payload->current_address_string[6]->long_name;
              $session_draft_job->city = $payload->current_address_string[3]->long_name;
              $session_draft_job->suburb = $payload->current_address_string[2]->long_name;
              $session_draft_job->job_lat = $payload->job_lat;
              $session_draft_job->job_lng = $payload->job_lng;
          }  
          $session_draft_job->service_category_id = $payload->service_category_id;
          $session_draft_job->service_category_name = $payload->service_category_name;
          $session_draft_job->service_subcategory_name = $payload->service_subcategory_name;
          $session_draft_job->service_subcategory_id = $payload->service_subcategory_id;
          if($session_draft_job->save()) {
            return Response::json($session_draft_job);
          }
      }
      //return the default false response if the any of the logic above doesn't work
       return Response::json(false);;
    }


    protected function retrieve_draft_job(Request $request) {

    }

    protected function store_draft_job_attachment(Request $request) {

    }

    protected function retrieve_draft_job_attachments(Request $request) {

    }

}
