<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\User;
use App\ServiceCategory;
use App\SessionDraftJob;
use App\SessionDraftJobAttachment;
use App\Job;
use Validator;
use Auth;
use Session;
use Response;
use DB;

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


    //service provider demo routes
    protected function service_provider_home(Request $request){
      $jobs = Job::where('status', '!=', 'DRAFT')->get();
      return view("service_provider.demo.home")->with('jobs', $jobs);
    }

    
    //load all job based on user loction in demo mode
    protected function service_provider_fetch_all_jobs(){
      $filter_action = $_POST['filter_action'];
      //based on user distance from current location
      $jobs = DB::table("jobs")
        ->select("jobs.*" , "jobs.id as job_id"
          ,DB::raw("6371 * acos(cos(radians(" . $_POST['current_lat'] . ")) 
          * cos(radians(jobs.job_lat)) 
          * cos(radians(jobs.job_lng) - radians(" . $_POST['current_lng'] . ")) 
          + sin(radians(" .$_POST['current_lat']. ")) 
          * sin(radians(jobs.job_lat))) AS distance"))
          ->where("jobs.status", "OPEN")
          ->having('distance', '<=', 200)
          ->groupBy("job_id")
          ->orderBy('distance', 'asc')
          ->get();
		//render the html page.
		$viewRendered = view('service_provider.demo.jobs.jobs_templates.jobs_homepgae_template_list', compact('jobs'))->render();
		return Response::json(['html'=>$viewRendered, 'jobs'=>$jobs]);
    }


    protected function service_provider_show_job($id){
        $job = Job::find($id);
        if($job != null){
          //do not show the job to other service provider if the job is not open and service provider id is already assigned.
          if($job->status == 'OPEN') {
            //find the sevrice seeker of this job and send info to blade view.
            $service_seeker_profile = User::find($job->service_seeker_id);
            //retrieve job extras 
            $job_extras = $job->extras->where('status', 'ACTIVE');
            $reply_count = 0;
            $job_price = 0.00;
            return View::make("service_provider.demo.jobs.job_detail")
                ->with('job',$job)
                ->with('service_seeker_profile', $service_seeker_profile);
          }    
        }
        return redirect()->back();
    }


    //service seeker home page query handler
    protected function service_seeker_home(Request $request) {
      $categories = ServiceCategory::all();
      $session_draft_job = SessionDraftJob::where('id', Session::getID())->first();
  
      if($request->has('showSPSView')){
        return view("service_seeker.demo.home_3")->with('session_draft_job', $session_draft_job);
      }

      if($request->has('showBooking')){
        return view("service_seeker.demo.home_2")->with('categories', $categories)->with('session_draft_job', $session_draft_job);
      } 
      else
      {
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
          $session_draft_job->street_number = $payload->current_address_string->street_number;
          $session_draft_job->street_name = $payload->current_address_string->street_name;
          $session_draft_job->state = $payload->current_address_string->state;
          $session_draft_job->postcode = $payload->current_address_string->postcode;
          $session_draft_job->city =$payload->current_address_string->city;
          $session_draft_job->suburb = $payload->current_address_string->suburb;
          $session_draft_job->job_lat = $payload->job_lat;
          $session_draft_job->job_lng = $payload->job_lng;
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
          $session_draft_job->street_number = $payload->current_address_string->street_number;
          $session_draft_job->street_name = $payload->current_address_string->street_name;
          $session_draft_job->state = $payload->current_address_string->state;
          $session_draft_job->postcode = $payload->current_address_string->postcode;
          $session_draft_job->city =$payload->current_address_string->city;
          $session_draft_job->suburb = $payload->current_address_string->suburb;
          $session_draft_job->job_lat = $payload->job_lat;
          $session_draft_job->job_lng = $payload->job_lng;
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

    
    protected  function retrieve_draft_job(){
      $session_draft_job = SessionDraftJob::where('id', Session::getId())->first();
      return Response::json($session_draft_job);
    }


    protected function retrieve_session_draft_sp_list(){
       $session_draft_job = SessionDraftJob::where('id', Session::getId())->first();
       if($session_draft_job != null) {
          $service_providers = DB::table("users")
            ->join('service_provider_services', 'users.id', '=', 'service_provider_services.user_id')
            ->select("users.*" , "users.id as user_id"
            ,DB::raw("6371 * acos(cos(radians(" . $session_draft_job->job_lat . ")) 
            * cos(radians(users.user_lat)) 
            * cos(radians(users.user_lng) - radians(" . $session_draft_job->job_lng . ")) 
            + sin(radians(" .$session_draft_job->job_lat. ")) 
            * sin(radians(users.user_lat))) AS distance"))
            ->where("users.is_online", true)
            ->where("users.is_verified", true)
            ->where("service_provider_services.service_cat_id",$session_draft_job->service_subcategory_id)
            ->having('distance', '<=', 200)
            ->groupBy("user_id")
            ->orderBy('distance', 'asc')
            ->get();
            return Response::json($service_providers);
       } else {
         return Response::json(array());
       }
    }

    
    //rendered view for service provider display for map selector
    protected function retrieve_session_draft_sp_info(){
      $user_id = $_POST['user_id'];
      $user = User::find($user_id);
      if($user != null) {
        $certificates = $user->certificates;
        $languages = $user->languages;
        $user_services = $user->service_provider_services;
        $stats = $this->calcualte_user_job_stats($user_id);
        $rendered_view = view('service_seeker.demo.partial.service_provider_info')
                        ->with('certificates', $certificates)
                        ->with('current_languages', $languages)
                        ->with('user_services', $user_services)
                        ->with('user', $user)
                        ->with('stats', $stats)
                        ->render();
        return Response::json($rendered_view);
      } else {
        return Response::json(false);
      }
     
    }


    //calcualte job stats for service provider. Also exists in Service Provider Controller
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


    //session draft job attachment controller funtions
    //store session draft job image 
    protected function store_session_draft_job_attachment(Request $request) {
        $validation = Validator::make($request->all(), [
          'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:100000',
          'current_session_id' => 'required'
        ]);
        if($validation->passes())
        {
          $image = $request->file('file');
          $new_name = rand() . '.' . $image->getClientOriginalExtension();
          $image->move(storage_path('/public/job_attachments/'), $new_name);
          $new_image_attachment = new SessionDraftJobAttachment();
          $new_image_attachment->path = $new_name;
          $new_image_attachment->name = 'Job Image';
          $new_image_attachment->session_draft_job_id   = $request->all()['current_session_id'];
          $new_image_attachment->save();
          return response()->json([
            'message'   => 'Image Upload Successfully',
            'uploaded_image' => '<img src="/storage/job_attachments/'.$new_name.'" class="img-thumbnail" width="300" />',
            'class_name'  => 'alert-success'
          ]);
        }
        else
        {
          return response()->json([
          //  'message'   => $validation->errors()->all(),
          //  'uploaded_image' => '',
          //  'class_name'  => 'alert-danger'
          ]);
        }
    }

    //retrieve all draft job images
    protected function retrieve_session_draft_job_attachment(){
        $current_session_id = $_POST['current_session_id'];
        $session_draft_job = SessionDraftJob::find($current_session_id);
        if($session_draft_job != null) {
          return Response::json($session_draft_job->session_draft_job_attachments);
        } else {
          return Response::json(array());
        }
    }
    
    // draft function
    function remove_job_images(){
      $id = $_POST['job_attachment_id'];
      $attachment = SessionDraftJobAttachment::find($id);    
      $response = false;
      if($attachment != null){
        if($attachment->path != null) { 
          if(file_exists(storage_path('/public/job_attachments/'.$attachment->path))){
              unlink(storage_path('/public/job_attachments/'.$attachment->path));
              $attachment->delete();
              $response = true;
          }
        }
      } 
      return Response::json(true);
    }

    //fetch nearby service providers
    function fetch_service_provider_nearby(){
      $lat = $_POST['user_current_lat'];
      $lng = $_POST['user_current_lng'];
      $radius = 100;
      
      $users =  DB::table("users")
            ->select("users.user_lat","users.user_lng","users.id","users.profile_image_path","users.first","users.last" ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
            * cos(radians(users.user_lat)) 
            * cos(radians(users.user_lng) - radians(" . $lng . ")) 
            + sin(radians(" .$lat. ")) 
            * sin(radians(users.user_lat))) AS distance"))
            //->where('users.is_online', true)
            ->having('distance', '<=', $radius)
            ->orderBy('distance', 'asc')
            ->take(10)
            ->get(); 
      return Response::json($users);
    }

}
