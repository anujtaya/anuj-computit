<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Job;
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
use App\Notifications\JobConversationNewMessageServiceSeeker;
use App\Notifications\JobQuoteOfferRejected;
use App\Notifications\JobQuoteOfferAccepted;
use App\ServiceseekerStripePaymentSource;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class ServiceSeekerJobController extends Controller
{
    

    protected function show_jobs(){
      $seeker_jobs = Job::where('service_seeker_id',  Auth::id())
                      ->leftJoin('conversations', 'jobs.id', '=', 'conversations.job_id')
                      ->groupBy('jobs.id')
                      ->where('jobs.status', '!=', 'DRAFT')
                      ->where('jobs.status', '!=', 'COMPLETED')
                      ->where('jobs.status', '!=', 'CANCELLED')
                      ->orderBy('jobs.job_date_time', 'desc')
                      ->get(['jobs.*', DB::raw('count(conversations.id) as conversations')]);
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

        //exit the flow and redirect user to expire job detail view
        // if($job->status == 'EXPIRED') {
        //   return redirect()->route('service_seeker_jobs_expired_job_display',$job->id);
        // }


        if($job->status == 'OPEN' || $job->status == 'CANCELLED' || $job->status == 'EXPIRED') {
          $conversations = [];
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

    //service provider job cordinates job tracking information
    protected function job_notify_arrival(){
      $job = Job::find($_POST['job_tracking_id']);
      if($job != null ) {
        if(Auth::id() == $job->service_seeker_id) {
          if(!Session::has('sp_proximity_alert_sent')) {
            $title = 'Your Provider is nearly here.';
            $message = 'Your provider '.$job->service_provider_profile->first.' nearly here, please get ready for their arrival.';
            $this->send_user_mobile_notification(Auth::user(), $title, $message);
            Session::put('sp_proximity_alert_sent', 'yes');
            return Response::json(true);
          }
        } 
      } 
      return Response::json(false); 
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
      $jobs = [];
      if($filter_action === "ALL"){
        $jobs = 
        Job::where('service_seeker_id',   $user_id)
                      ->leftJoin('conversations', 'jobs.id', '=', 'conversations.job_id')
                      ->groupBy('jobs.id')
                      ->where('jobs.status', '!=', 'DRAFT')
                      ->where('jobs.status', '!=', 'COMPLETED')
                      ->where('jobs.status', '!=', 'CANCELLED')
                      ->orderBy('jobs.job_date_time', 'desc')
                      ->get(['jobs.*', DB::raw('count(conversations.id) as conversations')]);
      }else{
        $jobs =
        Job::where('service_seeker_id',   $user_id)
        ->leftJoin('conversations', 'jobs.id', '=', 'conversations.job_id')
        ->groupBy('jobs.id')
        ->where('jobs.status', $filter_action)
        ->orderBy('jobs.job_date_time', 'desc')
        ->get(['jobs.*', DB::raw('count(conversations.id) as conversations')]);
      }
      //render the html page.
      $viewRendered = view('service_seeker.jobs.jobs_templates.jobs_templates_list', compact('jobs'))->render();
      return Response::json(['html'=>$viewRendered, 'jobs'=>$jobs]);
    }

    protected function filter_job_offer(){
      $filter_action = $_POST['filter_action'];
      $job_id = $_POST['job_id'];
      //$user_id = Auth::id();
      $job = Job::find($job_id);
      if($job != null){
          if($filter_action == 'NONE') {
            $conversations =  Conversation::where('job_id', $job->id)
            ->select('conversations.*', 'users.user_lat','users.user_lng','users.user_city', 'users.user_state' ,'users.profile_image_path','users.first' ,'users.last','users.rating',
                    DB::raw("6371 * acos(cos(radians(" . $_POST['job_lat'] . ")) 
                    * cos(radians(users.user_lat)) 
                    * cos(radians(users.user_lng) - radians(" . $_POST['job_lng'] . ")) 
                    + sin(radians(" .$_POST['job_lat']. ")) 
                    * sin(radians(users.user_lat))) AS distance") )
            ->join('users', 'conversations.service_provider_id', '=', 'users.id')
            //->where('conversations.status', 'OPEN')
            ->get();
            $conversations = $conversations->sortByDesc('created_at');
            $viewRendered = view('service_seeker.jobs.jobs_templates.job_filter_offer')->with('conversations', $conversations)->render();
            return Response::json(['html'=>$viewRendered, 'conversations'=>$conversations]);
          } else if($filter_action == "PRICEHL"){
            $conversations =  Conversation::where('job_id', $job->id)
            ->select('conversations.*', 'users.user_lat','users.user_lng','users.user_city', 'users.user_state' ,'users.profile_image_path','users.first' ,'users.last','users.rating',
                    DB::raw("6371 * acos(cos(radians(" . $_POST['job_lat'] . ")) 
                    * cos(radians(users.user_lat)) 
                    * cos(radians(users.user_lng) - radians(" . $_POST['job_lng'] . ")) 
                    + sin(radians(" .$_POST['job_lat']. ")) 
                    * sin(radians(users.user_lat))) AS distance") )
            ->join('users', 'conversations.service_provider_id', '=', 'users.id')
            //->where('conversations.status', 'OPEN')
            ->get();

            $conversations = $conversations->sortByDesc('json.offer');
            $viewRendered = view('service_seeker.jobs.jobs_templates.job_filter_offer')->with('conversations', $conversations)->render();
            return Response::json(['html'=>$viewRendered, 'conversations'=>$conversations]);
          } 
          else if($filter_action == "PRICELH"){
            $conversations =  Conversation::where('job_id', $job->id)
            ->select('conversations.*', 'users.user_lat','users.user_lng','users.user_city', 'users.user_state' ,'users.profile_image_path','users.first' ,'users.last','users.rating',
                    DB::raw("6371 * acos(cos(radians(" . $_POST['job_lat'] . ")) 
                    * cos(radians(users.user_lat)) 
                    * cos(radians(users.user_lng) - radians(" . $_POST['job_lng'] . ")) 
                    + sin(radians(" .$_POST['job_lat']. ")) 
                    * sin(radians(users.user_lat))) AS distance") )
            ->join('users', 'conversations.service_provider_id', '=', 'users.id')
          //  ->where('conversations.status', 'OPEN')
            ->get();

            $conversations = $conversations->sortBy('json.offer');
            $viewRendered = view('service_seeker.jobs.jobs_templates.job_filter_offer')->with('conversations', $conversations)->render();
            return Response::json(['html'=>$viewRendered, 'conversations'=>$conversations]);
          }
          else if($filter_action == "RATING"){
            $conversations =  Conversation::where('job_id', $job->id)
            ->select('conversations.*', 'users.user_lat','users.user_lng','users.user_city', 'users.user_state' ,'users.profile_image_path','users.first' ,'users.last','users.rating',
                    DB::raw("6371 * acos(cos(radians(" . $_POST['job_lat'] . ")) 
                    * cos(radians(users.user_lat)) 
                    * cos(radians(users.user_lng) - radians(" . $_POST['job_lng'] . ")) 
                    + sin(radians(" .$_POST['job_lat']. ")) 
                    * sin(radians(users.user_lat))) AS distance") )
            ->join('users', 'conversations.service_provider_id', '=', 'users.id')
            //->where('conversations.status', 'OPEN')
            ->orderBy('rating', 'desc')
            ->get();


            $viewRendered = view('service_seeker.jobs.jobs_templates.job_filter_offer')->with('conversations', $conversations)->render();
            return Response::json(['html'=>$viewRendered, 'conversations'=>$conversations]);
          }
          else if($filter_action == "DISTANCE"){
            $conversations =  Conversation::where('job_id', $job->id)
            ->select('conversations.*', 'users.user_lat','users.user_lng','users.user_city', 'users.user_state' ,'users.profile_image_path','users.first' ,'users.last','users.rating',
                    DB::raw("6371 * acos(cos(radians(" . $_POST['job_lat'] . ")) 
                    * cos(radians(users.user_lat)) 
                    * cos(radians(users.user_lng) - radians(" . $_POST['job_lng'] . ")) 
                    + sin(radians(" .$_POST['job_lat']. ")) 
                    * sin(radians(users.user_lat))) AS distance") )
            ->join('users', 'conversations.service_provider_id', '=', 'users.id')
           // ->where('conversations.status', 'OPEN')
            ->orderBy('distance', 'asc')
            ->get();


            $viewRendered = view('service_seeker.jobs.jobs_templates.job_filter_offer')->with('conversations', $conversations)->render();
            return Response::json(['html'=>$viewRendered, 'conversations'=>$conversations]);
          }
          else {
            return Response::json(false);
          }
         
      } 
    
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
          $job->street_number = $job_obj->current_address_string->street_number;
          $job->street_name = $job_obj->current_address_string->street_name;
          $job->state = $job_obj->current_address_string->state;
          $job->postcode = $job_obj->current_address_string->postcode;
          $job->city =$job_obj->current_address_string->city;
          $job->suburb = $job_obj->current_address_string->suburb;
          $job->service_category_id = $job_obj->service_category_id;
          $job->service_category_name = $job_obj->service_category_name;
          $job->service_subcategory_name = $job_obj->service_subcategory_name;
          $job->service_subcategory_id = $job_obj->service_subcategory_id;
          $job->job_lat = $job_obj->job_lat;
          $job->job_lng = $job_obj->job_lng;
          $job->status = "OPEN";
          $job->job_type = $job_obj->job_type;
        
          $job->job_pin = mt_rand(1000,9999);
          if($job->job_type == 'BOARD') {
            $response = $job->save();
            if($response){
              //$this->send_notification_job_board_notification($job);
              //mobile notification
              $title = 'We have successfully posted your job to job board.';
              $message = 'Service Provider will respond to your job with quotes soon. Visit LocaL2LocaL Job menu to see more info about the job. Your unique job id is:#'.$job->id;
              $this->send_user_mobile_notification(Auth::user(), $title, $message);
            }
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
        $job->street_number = $job_obj->current_address_string->street_number;
        $job->street_name = $job_obj->current_address_string->street_name;
        $job->state = $job_obj->current_address_string->state;
        $job->postcode = $job_obj->current_address_string->postcode;
        $job->city =$job_obj->current_address_string->city;
        $job->suburb = $job_obj->current_address_string->suburb;
        $job->service_category_id = $job_obj->service_category_id;
        $job->service_category_name = $job_obj->service_category_name;
        $job->service_subcategory_name = $job_obj->service_subcategory_name;
        $job->service_subcategory_id = $job_obj->service_subcategory_id;
        $job->job_lat = $job_obj->job_lat;
        $job->job_lng = $job_obj->job_lng;
        $job->status = "OPEN";
        $job->job_type = $job_obj->job_type;
        $job->job_pin = mt_rand(1000,9999);
        if($job->job_type == 'BOARD') {
          $response = $job->save();
          if($response){
            //$this->send_notification_job_board_notification($job);
            //mobile notification
            $title = 'We have successfully posted your job to job board.';
            $message = 'We have succesfully posted the job on job board. Service Provider will respond to your job with quotes soon. Visit LocaL2LocaL Job menu to see more info about the job. Your unique job id is:#'.$job->id;
            $this->send_user_mobile_notification(Auth::user(), $title, $message);
          }
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
                            ->select('conversation_messages.*')
                            ->where('service_provider_id', $service_provider_id)
                            ->join('conversation_messages', 'conversation_messages.conversation_id', 'conversations.id')
                            ->join('users', 'users.id', 'conversation_messages.user_id')
                            ->orderBy('conversation_messages.msg_created_at', 'ASC')
                            ->get();
      //dd($conversation_messages);
      foreach($conversation_messages as $message) {
          if($message->user_id != Auth::id()) {
            $conversation_message = ConversationMessage::find($message->id);
            $conversation_message->is_read = true;
            $conversation_message->save();
          }
      }
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
          //$this->send_notification_job_conversation_new_message($conversation,$message);
          //mobile notification
          $title = 'New Message from Service Seeker - '.Auth::user()->first.'.';
          $message = Auth::user()->first.' has responded to a job with id:#'.$conversation->job_id;
          $this->send_user_mobile_notification($conversation->service_provider_profile, $title, $message);
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
  protected function accept_offer(Request $request){
    $input = Input::all();
    $job = Job::find($input['accept_job_id']);
    $conversation = Conversation::find($input['accept_conversation_id']);

    if($job == null || $conversation == null) {
      return redirect()->back();
    }

    //save conversation 
    $conversation = Conversation::find($conversation->id);
    $conversation_message = new ConversationMessage();
    $conversation_message->user_id = Auth::id();
    $conversation_message->text = 'Accepted the offer for '.$conversation->json['offer'].'. The job offer for this job cannot be changed.';
    $conversation_message->conversation_id = $conversation->id;
    $conversation_message->msg_created_at = Carbon::now();
    $conversation_message->json = ["type" => "ACTION", "status"=> "ACCEPTED"];
    $conversation_message->save();
    
    $job->status = 'APPROVED';
    $job->service_provider_id = $conversation->service_provider_id;
    $job->save();
    $conversations = Conversation::where('job_id', $job->id)
                    ->join('users', 'conversations.service_provider_id', '=', 'users.id')
                    ->get();
    //send notification
    //$this->send_notification_job_offer_accepted($conversation);
    //mobile notification
    $title = 'Congratulations! Job Quote Offer Accepted by Service Seeker';
    $message = 'Please visit your Service Provider Jobs menu for more information. The job id is:#'.$job->id;
    $this->send_user_mobile_notification($conversation->service_provider_profile, $title, $message);
    return redirect()->route('service_seeker_job', $job->id);
  
  }


  protected function reject_offer($job_id, $conversation_id){
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

        if($conversation_message->save()){
          //send notification
          $conversation->status = 'CLOSED';
          $conversation->save();

          //email notification
          //$this->send_notification_job_offer_rejected($conversation);
          //mobile notification
          $title = 'Job Quote Offer Rejected by Service Seeker';
          $message = 'Please visit your Service Provider Jobs menu for more information. The job id is:#'.$job->id;
          $this->send_user_mobile_notification($conversation->service_provider_profile, $title, $message);


          return redirect()->route('service_seeker_job', $job->id);
        }
    }
    return redirect()->back();
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
        //return redirect()->route('service_seeker_home');
			} 
			return redirect()->back()->withInput()->withErrors($validator);
		}	
  }
  

  //send an invocie to service provider account with onclick action
	function service_seeker_email_invoice($id){
    $job = Job::find($id);
    $job->is_invoice_sent = true;
    $job->save();
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
    $temp->user_name = $job->service_seeker_profile->first;
		$user = User::find($job->service_seeker_id);
		$user->notify(new ServiceSeekerEmailInvoice($temp));
		if(file_exists($dest_path)){
            unlink($dest_path);
        }
    

    //send push notification for invoice delivery
    $this->send_user_mobile_notification($job->service_seeker_profile, 'Invoice Delivered successfully','Invoice for job with id #'.$job->id.' delivered to your nominated email account.');


		Session::put('status', 'An email has been sent.');
		return redirect()->back();
  }
  
  //service seeker cancel job handler
  function service_seeker_job_cancel(Request $request) {
    $data =  (object) Input::all(); 
    $job = Job::find($data->ss_job_cancel_id);
    if($job != null) {
      //for now refund the money
      $job_payment = $job->job_payments;
      if($job_payment != null) {
        $refund_response = $this->precharge_refund_job_payment($job_payment);
        if($refund_response) {
          $job_payment->status = "REFUNDED";
          $job_payment->save();
        }  
      }
      $job->status = 'CANCELLED';
      $job->save();  
    }
    return redirect()->back();
  }


//record job payment
function record_job_payment($job, $conversation,$stripe_payment_customer_object,$payment_method) {
  $response =  false;
  $charge_amount = $conversation->json['offer'];
  if($payment_method == 'STRIPE') {
    try {
      \Stripe\Stripe::setApiKey(config('app.stripe_private_key'));
      $charge_response = \Stripe\Charge::create ( array (
                  "amount" => $charge_amount * 100,
                  "currency" => "aud",
                  "customer" => $stripe_payment_customer_object->stripe_payment_token_id,
                  "description" => $job->id. '--'. $job->title,
                  'receipt_email' => $job->service_seeker_profile->email,
                  "capture" => false,
          ) );
        if($charge_response->id != '') {
          //store payment details
          $new_charge = new \App\JobPayment();
          $new_charge->job_id = $job->id;
          $new_charge->payment_reference_number = $charge_response->id;
          $new_charge->payment_method = 'STRIPE';
          $new_charge->payable_job_price = $charge_amount;
          $new_charge->notes = 'TEMPORARY HOLD UNTIL THE JOB IS COMPLETED';
          $new_charge->status = 'UNPAID';
          if($new_charge->save()) {
            $response = true;
          }
        }
     }
    catch (\Stripe\Error\InvalidRequest $e){Session::put('CardError', $e->getMessage() );  $response = false; }
    catch (\Stripe\Error\Card $e){Session::put('CardError', $e->getMessage() ); $response = false; }
    catch (\Stripe\Error\Customer $e){Session::put('CardError', $e->getMessage() );$response = false;}
    catch (\Stripe\Error\Account $e){Session::put('CardError', $e->getMessage() ); $response = false;}
    
  }
  return $response;
}



//precharge_refund
function precharge_refund_job_payment($job_payment){
    $response = false;
    if($job_payment != null) {
      if($job_payment->payment_method == 'STRIPE') {
        try {
            \Stripe\Stripe::setApiKey(config('app.stripe_private_key'));
            $charge = \Stripe\Refund::create([
            'charge' => $job_payment->payment_reference_number,
            'reason' => 'requested_by_customer',
            ]);
            $response =  true;
        }
        catch (\Stripe\Error\InvalidRequest $e){$response =  $e->getMessage();}
        catch (\Stripe\Error\Card $e){$response =  $e->getMessage();}
        catch (\Stripe\Error\Refund $e){$response =  $e->getMessage();}
        catch (\Stripe\Error\Customer $e){$response =  $e->getMessage();}
        catch (\Stripe\Error\Account $e){$response =  $e->getMessage();}
      }
    }
    return $response;
}
 


//job status update retrival function
protected function job_request_stutus_update(){
    $job_id = $_POST['job_id'];
    $job = Job::find($job_id);
    if($job != null) {
      return Response::json($job->status);
    }else {
      return REsponse::json(false);
    }
  }


//fetched the service provider info for service seeker map modal view display
protected function job_request_provider_info(){
  $user_id = $_POST['user_id'];
  $job_id = $_POST['job_id'];
  $user = User::find($user_id);
  if($user != null) {
    //find conversation data for the given service provider id and job id
    $conversation = Conversation::where('job_id', $job_id)->where('service_provider_id', $user->id)->first();
    if($conversation == null) {
      return Response::json(false);
    } 

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
                    ->with('conversation', $conversation)
                    ->render();
    return Response::json($rendered_view);
  } else {
    return Response::json(false);
  }
}


//notification functions below
//job board notification
// protected function send_notification_job_board_notification($job){
//   $data = new \stdClass();
//   $data->job_id = $job->id;
//   $data->service_seeker_name = $job->service_seeker_profile->first;
//   //email
//   Auth::user()->notify(new JobBoardNotification($data));
//   //sms
//   //push notification
// }


// //service seeker respond to service provider message
// protected function send_notification_job_conversation_new_message($conversation,$message){
//   $user = User::find($conversation->job->service_seeker_id);
//   if($user != null) {
//     $service_provider_info = User::find($conversation->service_provider_id);
//     $data = new \stdClass();
//     $data->job_id = $conversation->job_id;
//     $data->service_seeker_name = $user->first;
//     $data->service_provider_name = $service_provider_info->first;
//     $data->message = $message;
//     //email
//     $service_provider_info->notify(new JobConversationNewMessageServiceSeeker($data));
//     //sms
//     //push notification
//   }
// }

//service seeker rejects service provider job offer
// protected function send_notification_job_offer_rejected($conversation){
//   $user = User::find($conversation->job->service_seeker_id);
//   if($user != null) {
//     $service_provider_info = User::find($conversation->service_provider_id);
//     $data = new \stdClass();
//     $data->job_id = $conversation->job_id;
//     $data->service_seeker_name = $user->first;
//     $data->service_provider_name = $service_provider_info->first;
//     $data->offer = $conversation->json['offer'];
//     //email
//     $service_provider_info->notify(new JobQuoteOfferRejected($data));
//     //sms
//     //push notification
//   }
// }

//service seeker accepts service provider job offer
protected function send_notification_job_offer_accepted($conversation){
  $user = User::find($conversation->job->service_seeker_id);
  if($user != null) {
    $service_provider_info = User::find($conversation->service_provider_id);
    $data = new \stdClass();
    $data->job_id = $conversation->job_id;
    $data->service_seeker_name = $user->first;
    $data->service_provider_name = $service_provider_info->first;
    $data->offer = $conversation->json['offer'];
    //email
    $service_provider_info->notify(new JobQuoteOfferAccepted($data));
    //sms
    //push notification
  }
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
