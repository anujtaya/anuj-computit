<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Job;
use App\Bid;
use App\Conversation;
use App\ConversationMessage;
use App\User;
use Auth;
use Response;
use Carbon\Carbon;
use Session;
use Validator;
use Input;
use App\Notifications\ServiceSeekerEmailInvoice;
use PDF;
use DB;
use Notifiable;
use App\Notification;
use App\Notifications\JobBoardNotification;
use App\Notifications\JobInstantNotification;
use App\Notifications\JobInstantServiceProviderSelectionNotification;
use App\Notifications\JobConversationNewMessageServiceSeeker;
use App\Notifications\JobQuoteOfferRejected;
use App\Notifications\JobQuoteOfferAccepted;

class ServiceSeekerJobController extends Controller
{
    

    protected function show_jobs(){
      $seeker_jobs = Job::where('service_seeker_id', Auth::id())
                      ->where('status', '!=', 'DRAFT')
                      ->where('status', '!=', 'COMPLETED')
                      ->where('status', '!=', 'CANCELLED')
                      ->orderBy('job_date_time', 'desc')->get();
      return View::make("service_seeker.jobs.jobs")->with('jobs', $seeker_jobs);
    }


    protected function show_job($id){
      //get job details
      $job = Job::find($id);
      if($job){
        if($job->service_seeker_id != Auth::id()) {
          abort(403, 'You are not authrised to access this resource.');
        }
        //get bids related to this job
        $conversation_current = null;
        $conversations = null;
        $job_extras = $job->extras->where('status', 'ACTIVE');
        $job_price = 0.00;
        if($job->status == 'OPEN' || $job->status == 'CANCELLED' ) {
          $conversations = Conversation::where('job_id', $job->id)
                ->select('conversations.*')
                ->join('users', 'conversations.service_provider_id', '=', 'users.id')
                ->where('conversations.status', 'OPEN')
                ->get();
                //dd($conversations);
        } else {
          $conversation_current = Conversation::where('job_id', $job->id)->where('service_provider_id', $job->service_provider_id)->first();
          $conversation_current->service_provider_information = $conversation_current->service_provider_profile;
          if($conversation_current!=null){
            $job_price = $this->calculate_job_price($job_extras, $conversation_current);
          }
        }
       
        $job_attachments = $job->attachments;
        return View::make("service_seeker.jobs.job_detail")
              ->with('job',$job)
              ->with('conversations',$conversations)
              ->with('conversation_current',$conversation_current)
              ->with('job_attachments', $job_attachments)
              ->with('job_extras', $job_extras)
					    ->with('job_price', $job_price);
      }else{
  			return redirect()->back();
  		}
    }

    //service provider job cordinates job tracking information
    protected function job_tracking_info($sp_id){
      $user = User::find($sp_id);
      if($user != null ) {
        return Response::json($user->current_location);
      } else {
        return Response::json(false);
      }
    }


    //calcualtes job final job total when job extras and conversation with a offer value is provided. Please pass the correct data to this function to avoid any calculation errors.
    protected function calculate_job_price($extras, $conversation){
      $final_price = 0.00;
      $offer_price = floatval($conversation->json['offer']);
      foreach($extras as $extra) {
        $final_price += $extra->quantity * $extra->price;
      }

      $final_price = $final_price + $offer_price;
      return $final_price;
    }


    protected function filter_jobs(){
      $filter_action = $_POST['filter_action'];
      $user_id = Auth::id();
      if($filter_action == "ALL"){
        $jobs = Job::where('service_seeker_id', Auth::user()->id)->where('status', '!=', 'DRAFT')->orderBy('job_date_time', 'desc')->get();
      }else{
        $jobs = Job::where('service_seeker_id', Auth::user()->id)->where('status', $filter_action)->orderBy('job_date_time', 'desc')->get();
      }
      //render the html page.
      $viewRendered = view('service_seeker.jobs.jobs_templates.jobs_templates_list', compact('jobs'))->render();
      return Response::json(['html'=>$viewRendered, 'jobs'=>$jobs]);
    }

    protected function filter_job_offer($job_id){
      $filter_action = $_POST['filter_action'];
      $user_id = Auth::id();
      if($job_id != null){
        $job = Job::find($job_id);
        if($job){
          $conversations = $job->conversations;
          if($filter_action == "PRICELH"){
            $conversations = $conversations->sortBy('json.offer');
          }else if($filter_action == "PRICEHL"){
            $conversations = $conversations->sortByDesc('json.offer');
          }
        }
      }
      $viewRendered = view('service_seeker.jobs.jobs_templates.job_filter_offer', compact('conversations'))->render();
      return Response::json(['html'=>$viewRendered, 'conversations'=>$conversations]);
    }


    //provides the function to retrieve job offer details/ service provider information/ data for modal view display
    protected function map_data_job_offer($job_id){
      $map_data =  Conversation::where('job_id', $job_id)
        ->select('conversations.*', 'users.user_lat','users.user_lng','users.user_city', 'users.user_state' ,'users.profile_image_path','users.first' ,'users.last','users.rating' )
        ->join('users', 'conversations.service_provider_id', '=', 'users.id')
        ->where('conversations.status', 'OPEN')
        ->get();
      return Response::json($map_data);
    }

    protected function request_job_draft(){
      $draft_obj = json_decode($_POST['draft_obj']);
      $seeker_id = Auth::user()->id;
      $response = false;
      if($draft_obj->service_subcategory_id != null){
        //check if user has a draft job available
        $draft_job = Job::where('status', 'DRAFT')->where('service_seeker_id', $seeker_id)->first();
        if($draft_job){
          $draft_job->title = $draft_obj->title;
          $draft_job->description = $draft_obj->description;
          $draft_job->service_category_id = $draft_obj->service_category_id;
          $draft_job->service_subcategory_id = $draft_obj->service_subcategory_id;
          if($draft_obj->job_date_time != null){
            $draft_job->job_date_time = $draft_obj->job_date_time;
          }
          $draft_job->job_lat = $draft_obj->job_lat;
          $draft_job->job_lng = $draft_obj->job_lng;
          $result = $draft_job->save();
          if($result){
            $response = $draft_job->id;
          }
        }else{
          //create a job
          $job = new Job();
          $job->title = $draft_obj->title;
          $job->description = $draft_obj->description;
          $job->status = "DRAFT";
          $job->service_category_id = $draft_obj->service_category_id;
          $job->service_subcategory_id = $draft_obj->service_subcategory_id;
          if($job->job_date_time != null){
            $job->job_date_time = $draft_obj->job_date_time;
          }
          $job->service_seeker_id = $seeker_id;
          $job->job_lat = $draft_obj->job_lat;
          $job->job_lng = $draft_obj->job_lng;
          $result = $job->save();
          if($result){
            $response = $job->id;
          }
        }
      }
      return Response::json($response);
    }
    

    protected function clear_job_draft(){
      $job_draft_id = $_POST['job_draft_id'];
      $response = false;
      if($job_draft_id != null){
        $job = Job::find($job_draft_id);
        if($job != null){
          //check and remove job attachment
          $job_attachments = $job->attachments;
          if(count($job_attachments) > 0){
            foreach($job_attachments as $att){
              $att->delete();
            }
          }
          $job->service_subcategory_id = null;
          $job->title = null;
          $job->description = null;
          $job->job_lat = null;
          $job->job_lng = null;
          $job->job_date_time = null;
          $response = $job->save();
        }
      }
      return Response::json($response);
    }

    
    protected function job_request_type_board(){
      $job_obj = json_decode($_POST['job_obj']);
      $seeker_id = Auth::user()->id;
      $response = false;
      //check whether a draft job exists for this job.
      if($job_obj->current_job_draft_id != null){
        $job = Job::where('id', $job_obj->current_job_draft_id)->where('status', 'Draft')->where('service_seeker_id', $seeker_id)->first();
        if($job){
          $job->title = $job_obj->title;
          $job->description = $job_obj->description;
          if($job_obj->job_date_time != null){
            $job->job_date_time = $job_obj->job_date_time;
          }
          $job->service_seeker_id = $seeker_id;
          $job->street_number = $job_obj->current_address_string[0]->long_name;
          $job->street_name = $job_obj->current_address_string[1]->long_name;
          $job->state = $job_obj->current_address_string[4]->long_name;
          $job->postcode = $job_obj->current_address_string[6]->long_name;
          $job->city = $job_obj->current_address_string[3]->long_name;
          $job->suburb = $job_obj->current_address_string[2]->long_name;
          $job->service_category_id = $job_obj->service_category_id;
          $job->service_category_name = $job_obj->service_category_name;
          $job->service_subcategory_name = $job_obj->service_subcategory_name;
          $job->service_subcategory_id = $job_obj->service_subcategory_id;
          $job->job_lat = $job_obj->job_lat;
          $job->job_lng = $job_obj->job_lng;
          $job->status = "OPEN";
          $job->job_type = $job_obj->job_type;
        
          $job->job_pin = mt_rand(1000,9999);
          $response = $job->save();
          if($response && $job->job_type == 'BOARD') {
            $this->send_notification_job_board_notification($job);
          } else if ($response && $job->job_type == 'INSTANT'){
            $this->send_notification_job_insant_notification($job);
          }
        }
      }else{
        $job = new Job();
        $job->title = $job_obj->title;
        $job->description = $job_obj->description;
        if($job_obj->job_date_time != null){
          $job->job_date_time = $job_obj->job_date_time;
        }
        $job->service_seeker_id = $seeker_id;
        $job->street_number = $job_obj->current_address_string[0]['long_name'];
        $job->street_name = $job_obj->current_address_string[1]['long_name'];
        $job->state = $job_obj->current_address_string[4]['long_name'];
        $job->postcode = $job_obj->current_address_string[6]['long_name'];
        $job->city = $job_obj->current_address_string[3]['long_name'];
        $job->suburb = $job_obj->current_address_string[2]['long_name'];
        $job->service_category_id = $job_obj->service_category_id;
        $job->service_category_name = $job_obj->service_category_name;
        $job->service_subcategory_name = $job_obj->service_subcategory_name;
        $job->service_subcategory_id = $job_obj->service_subcategory_id;
        $job->job_lat = $job_obj->job_lat;
        $job->job_lng = $job_obj->job_lng;
        $job->status = "OPEN";
        $job->job_type = $job_obj->job_type;
        $job->job_pin = mt_rand(1000,9999);
        $response = $job->save();
        if($response && $job->job_type == 'BOARD') {
          $this->send_notification_job_board_notification($job);
        } else if ($response && $job->job_type == 'INSTANT'){
          $this->send_notification_job_insant_notification($job);
        }
      }
      return Response::json($response);
    }

    protected function show_job_conversation($job_id, $service_provider_id){
      //make sure the messages are in right order
      $job = Job::find($job_id);
      $conversation = Conversation::where('job_id', $job_id)
                            ->where('service_provider_id', $service_provider_id)->first();
      $conversation_messages = Conversation::where('job_id', $job_id)
                            ->where('service_provider_id', $service_provider_id)
                            ->join('conversation_messages', 'conversation_messages.conversation_id', 'conversations.id')
                            ->join('users', 'users.id', 'conversation_messages.user_id')
                            ->orderBy('conversation_messages.msg_created_at', 'ASC')
                            ->get();
      return View::make("service_seeker.jobs.job_converstation")->with('msgs',$conversation_messages)->with('conversation',$conversation)->with('job', $job);
    }

    protected function send_message(){
      // needs if guards; make sure the request ids and their relevant data in table exists before quering the data.
      $conversation_id = $_POST['conversation_id'];
      $message = $_POST['message'];
      $response = false;
      if($conversation_id != null && $message != null){
        $conversation = Conversation::where('id',$conversation_id)->first();
        $msg = new ConversationMessage();
        $msg->user_id = Auth::id();
        $msg->conversation_id = $conversation->id;
        $msg->text = $message;
        $msg->msg_created_at = Carbon::now();
        $response = $msg->save();
        if($response){
          //change job status to pending if this is server seeker's first message
          $is_first_msg = ConversationMessage::where('conversation_id', $conversation->id)->where('user_id', Auth::id())->get();
          if(count($is_first_msg) == 1){
            $job = Job::find($conversation->job_id);
            $job->status = 'OPEN';
            $job->save();
          }
          //send notification
          $this->send_notification_job_conversation_new_message($conversation,$message);
        }
	    }
      return Response::json($response);
    }

    protected function check_new_messages(){
      $response = false;
      $conversation_id = $_POST['conversation_id'];
      if(isset($_POST['msgs'])){
        $msgs = $_POST['msgs'];
        $last_msg = end($msgs);
        // return Response::json($last_msg);
        $last_msg_created_at = $last_msg['msg_created_at'];
      } else {
        $last_msg_created_at = false;
      }
        // msgs array is sorted by msg_created_at ASC
        if(!$last_msg_created_at){
          $new_messages = ConversationMessage::where('conversation_id', $conversation_id)->first();
        }else{
          $new_messages = ConversationMessage::where('conversation_id', $conversation_id)->where('msg_created_at', '>', $last_msg_created_at)->first();
        }
        if($new_messages){
          $response = true;
          $response = $new_messages->conversation;
          $msgs = Conversation::where('job_id', $response['job_id'])
                  ->where('service_provider_id', $response['service_provider_id'])
                  ->where('msg_created_at', '>', $last_msg_created_at)
                  ->join('conversation_messages', 'conversation_messages.conversation_id', 'conversations.id')
                  ->join('users', 'users.id', 'conversation_messages.user_id')
                  ->orderBy('conversation_messages.msg_created_at', 'ASC')
                  ->get();
          $viewRendered = view('service_seeker.jobs.conversation_templates.job_conversation_messages_new', compact('msgs'))->render();
          return Response::json(['html'=>$viewRendered, 'msgs'=>$msgs]);
        }
      return Response::json($response);
    }


  //Service seeker job offer accept function. 
  protected function accept_offer($job_id, $conversation_id){
    if($job_id != null){
      $job = Job::find($job_id);
      if($job){
          $job->status = 'APPROVED';
          $response = $job->save();
          if($response){
            $conversation = Conversation::find($conversation_id);
            $conversation_message = new ConversationMessage();
            $conversation_message->user_id = Auth::id();
            $conversation_message->text = 'Accepted the offer for '.$conversation->json['offer'].'. The job offer for this job cannot be changed.';
            $conversation_message->conversation_id = $conversation_id;
            $conversation_message->msg_created_at = Carbon::now();
            $conversation_message->json = ["type" => "ACTION", "status"=> "ACCEPTED"];
            $response_r = $conversation_message->save();
            if($response_r) {
              $job->service_provider_id = $conversation->service_provider_id;
              $job->save();
              $conversations = Conversation::where('job_id', $job->id)
                      ->join('users', 'conversations.service_provider_id', '=', 'users.id')
                      ->get();
              //send notification
              $this->send_notification_job_offer_accepted($conversation);
              return redirect()->route('service_seeker_job', $job_id);
            }
          }
      }else{
        abort(404);
      }
    }else{
      abort(404);
    }
  }

  protected function reject_offer($job_id, $conversation_id){
    if($job_id != null){
      $job = Job::find($job_id);
      if($job){
          // store approved status message in converstation json property.
          $conversation = Conversation::find($conversation_id);
          $conversation_message = new ConversationMessage();
          $conversation_message->user_id = Auth::id();
          $conversation_message->conversation_id = $conversation_id;
          $conversation_message->text = 'Rejected the offer for '.$conversation->json['offer'].'.';
          $conversation_message->json = ["type" => "ACTION", "status"=> "REJECTED"];
          $conversation_message->msg_created_at = Carbon::now();
          $response = $conversation_message->save();

          if($response){
            //send notification
            $this->send_notification_job_offer_rejected($conversation);
            return redirect()->back();
          }
      }else{
        abort(404);
      }
    }else{
      abort(404);
    }
  }

  protected function timer(){
    return view('service_seeker.timer');
  }
  
  
  //service provider profile display without editing option (for service seeker's only)
  function service_seeker_service_provider_profile($service_provider_id){
    $user = User::find($service_provider_id);
    $certificates = $user->certificates;
    $languages = $user->languages;
    $user_services = $user->service_provider_services;
    $stats = $this->calcualte_user_job_stats($user->id);
    //dd($stats);
    //find a way to store cached user rating
    return View::make("service_seeker.jobs.partial.job_service_provider_profile")
          ->with('certificates', $certificates)
          ->with('current_languages', $languages)
          ->with('user_services', $user_services)
          ->with('user', $user)
          ->with('stats', $stats);
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

  //update service seeker rating
	function update_rating(Request $request){
		$validator =  Validator::make($request->all(), [
			'rating_job_id' => 'required',
			'ss_rating_start_value' => 'required'
		]);
		if ($validator->fails()) {
			return redirect()
					->back()
					->withErrors($validator)
					->withInput();
		} else {
			$data =  (object) Input::all();
			$job = Job::find($data->rating_job_id);
            if($job ->status == 'COMPLETED') {
				$job->service_seeker_rating = $data->ss_rating_start_value;
				$job->service_seeker_comment = $data->ss_rating_description_value;
				$job->save();
			} 
			return redirect()->back()->withInput()->withErrors($validator);
		}	
  }
  

  //send an invocie to service provider account with onclick action
	function service_seeker_email_invoice($id){
		$job = Job::find($id);
		$job_extras = $job->extras->where('status', 'ACTIVE');
		$conversation = Conversation::where('job_id', $job->id)
		          ->select('users.*', 'conversations.id as conversation_id', 'conversations.json', 'conversations.job_id', 'conversations.service_provider_id' )
	              ->join('users', 'conversations.service_provider_id', '=', 'users.id')
				  ->first();
		$pdf = PDF::loadView('invoice.ss_invoice_template' , array('job_id' => $id));
		$temp_name = 'invoice_'.rand(1,1000).'.pdf';
		$dest_path = public_path().'/temp_invoice/'.$temp_name;
		$pdf->save($dest_path);
		//create a email notification object
		$temp = new \stdClass();
		$temp->file_name = $dest_path;
		$user = User::find($job->service_provider_id);
		$user->notify(new ServiceSeekerEmailInvoice($temp));
		if(file_exists($dest_path)){
            unlink($dest_path);
        }
		Session::put('status', 'An email has been sent.');
		return redirect()->back();
  }
  
  //service seeker cancel job handler
  function service_seeker_job_cancel(Request $request) {
    $data =  (object) Input::all(); 
    $job = Job::find($data->ss_job_cancel_id);
    if($job != null) {
      //charge any cancellation fee if applicable
      $job->status = 'CANCELLED';
      $job->save();
    }
    return redirect()->back();
  }


  //service provider list for instant job map
  protected function job_instant_provider_list(){
    $job = Job::where('id', $_POST['job_id'])->first();
    if($job != null) {
       $service_providers = DB::table("users")
         ->join('service_provider_services', 'users.id', '=', 'service_provider_services.user_id')
         ->select("users.*" , "users.id as user_id"
         ,DB::raw("6371 * acos(cos(radians(" . $job->job_lat . ")) 
         * cos(radians(users.user_lat)) 
         * cos(radians(users.user_lng) - radians(" . $job->job_lng . ")) 
         + sin(radians(" .$job->job_lat. ")) 
         * sin(radians(users.user_lat))) AS distance"))
         ->where("users.is_online", true)
         ->where("users.is_verified", true)
         ->where("service_provider_services.service_cat_id",$job->service_subcategory_id)
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
 protected function job_instant_provider_info(){
   $user_id = $_POST['user_id'];
   $job_id = $_POST['job_id'];
   $user = User::find($user_id);
   if($user != null) {
     $certificates = $user->certificates;
     $languages = $user->languages;
     $user_services = $user->service_provider_services;
     $stats = $this->calcualte_user_job_stats($user_id);
     $rendered_view = view('service_seeker.jobs.partial.service_provider_info')
                     ->with('certificates', $certificates)
                     ->with('current_languages', $languages)
                     ->with('user_services', $user_services)
                     ->with('user', $user)
                     ->with('stats', $stats)
                     ->with('job_id', $job_id)
                     ->render();
     return Response::json($rendered_view);
   } else {
     return Response::json(false);
   }
  
 }

 //this function converts the job from instant job type into job board type.
 function service_seeker_job_posttojobboard(Request $request){
  $input = $request->all();
  $job = Job::find($input['ss_job_posttojobboard_id']);
  //check if job exitst
  if($job != null) {
    //check if job type is instant and job status is open and check if user booked the job
    if($job->job_type == 'INSTANT' && $job->status == 'OPEN' && $job->service_seeker_id == Auth::id()) {
      //convert the job to 'BOARD' type
      $job->job_type = 'BOARD';
      $job->service_provider_id = null;
      $job->status = 'OPEN';
      $job->save();
    }
  }
  return redirect()->back();
 }

 //assign a service provider to instant job type
 protected function job_instant_assign_service_provider(Request $request){
    $input = $request->all();
    $job = Job::find($input['job_instant_sp_selector_job_id']);
    $service_provider_id =  $input['job_instant_sp_selector_provider_id'];
    if($job != null && $service_provider_id != null) {
       //assign the service provider
       $job->service_provider_id = $service_provider_id;
       $job->job_sp_selector_date_time = Carbon::now();
       if($job->save()){
        $this->send_notification_job_insant_service_provider_selection($job);
       }
    }
    return redirect()->back();
 }

 //resets the job instant type to its originol values so the service seeker can select a different service provider
 protected function job_instant_reset_job(Request $request) {
  $input = $request->all();
  $job = Job::find($input['job_instant_sp_selector_job_id']);
  if($job != null) {
    $job->job_sp_selector_date_time = null;
    $job->service_provider_id = null;
    
    //remove the conversation if any between service provider and service seeker

    
    //let service provider know that the service seeker is no longer interested in the job 
    $job->save();
  }
   return redirect()->back();
 }

 //check if the ocnversation exists for instant job between provider and seeker
 protected function job_instant_provider_check_conversation_exists(){
  $service_provider_id = $_POST['service_provider_id'];
  $job_id = $_POST['job_id'];
  $conversation = Job::find($job_id)->conversations->where('service_provider_id', $service_provider_id)->first();
  if($conversation != null) {
    return Response::json(true);
  } else {
    return Response::json(false);
  }

 }


//notification functions below
//job board notification
protected function send_notification_job_board_notification($job){
  $data = new \stdClass();
  $data->job_id = $job->id;
  $data->service_seeker_name = $job->service_seeker_profile->first;
  //email
  Auth::user()->notify(new JobBoardNotification($data));
  //sms
  //push notification
}

//job instant notification
protected function send_notification_job_insant_notification($job){
  $data = new \stdClass();
  $data->job_id = $job->id;
  $data->service_seeker_name = $job->service_seeker_profile->first;
  Auth::user()->notify(new JobInstantNotification($data));
}

//instant job type service provider selection notification
protected function send_notification_job_insant_service_provider_selection($job){
  $user = User::find($job->service_provider_id);
  if($user != null) {
    //email
    $user->notify(new JobInstantServiceProviderSelectionNotification($job));
    //sms
    //push notification
  }
}

//service seeker respond to service provider message
protected function send_notification_job_conversation_new_message($conversation,$message){
  $user = User::find($conversation->job->service_seeker_id);
  if($user != null) {
    $service_provider_info = User::find($conversation->service_provider_id);
    $data = new \stdClass();
    $data->job_id = $conversation->job_id;
    $data->service_seeker_name = $user->first;
    $data->service_provider_name = $service_provider_info->first.' '.$service_provider_info->last;
    $data->message = $message;
    //email
    $service_provider_info->notify(new JobConversationNewMessageServiceSeeker($data));
    //sms
    //push notification
  }
}

//service seeker rejects service provider job offer
protected function send_notification_job_offer_rejected($conversation){
  $user = User::find($conversation->job->service_seeker_id);
  if($user != null) {
    $service_provider_info = User::find($conversation->service_provider_id);
    $data = new \stdClass();
    $data->job_id = $conversation->job_id;
    $data->service_seeker_name = $user->first;
    $data->service_provider_name = $service_provider_info->first.' '.$service_provider_info->last;
    $data->offer = $conversation->json['offer'];
    //email
    $service_provider_info->notify(new JobQuoteOfferRejected($data));
    //sms
    //push notification
  }
}

//service seeker accepts service provider job offer
protected function send_notification_job_offer_accepted($conversation){
  $user = User::find($conversation->job->service_seeker_id);
  if($user != null) {
    $service_provider_info = User::find($conversation->service_provider_id);
    $data = new \stdClass();
    $data->job_id = $conversation->job_id;
    $data->service_seeker_name = $user->first;
    $data->service_provider_name = $service_provider_info->first.' '.$service_provider_info->last;
    $data->offer = $conversation->json['offer'];
    //email
    $service_provider_info->notify(new JobQuoteOfferAccepted($data));
    //sms
    //push notification
  }
}





}
