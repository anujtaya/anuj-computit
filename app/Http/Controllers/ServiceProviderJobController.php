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
use Notifiable;
use App\Notifications\ServiceProviderEmailInvoice;
use App\Notifications\JobQuoteOfferSend;
use App\Notifications\JobConversationNewMessageServiceProvider;
use App\User;
use Carbon\Carbon;
use Input;
use Validator;
use PDF;
use Session;
use DB;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use App\ServiceProviderPaylog;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;


class ServiceProviderJobController extends Controller
{
	
	
	protected function show_job($id){
	    $job = Job::find($id);
		if($job != null){
			//do not show the job to other service provider if the job is not open and service provider id is already assigned.
			if($job->status != 'OPEN' && $job->service_provider_id != null) {
				if($job->service_provider_id != Auth::id()) {
					return redirect()->route('service_provider_jobs_history');
				}
			}
		  	$conversation = Conversation::where('job_id', $job->id)
		          ->select('users.*', 'conversations.id as conversation_id', 'conversations.json', 'conversations.job_id', 'conversations.service_provider_id' )
				  ->join('users', 'conversations.service_provider_id', '=', 'users.id')
				  ->where('users.id', Auth::id())
				  ->first();
			//find the sevrice seeker of this job and send info to blade view.
			$service_seeker_profile = User::find($job->service_seeker_id);
			//retrieve job extras 
			$job_extras = $job->extras->where('status', 'ACTIVE');
			$reply_count = 0;
			$job_price = 0.00;
			if($conversation != null) {
				$reply_count = count(Conversation::find($conversation->conversation_id)->conversation_messages);
				$job_price = $this->calculate_job_price($job_extras, $conversation);
			}
			 return View::make("service_provider.jobs.job_detail")
					 ->with('job',$job)
					 ->with('conversation',$conversation)
					 ->with('conversation_reply_count', $reply_count)
					 ->with('service_seeker_profile', $service_seeker_profile)
					 ->with('job_extras', $job_extras)
					 ->with('job_price', $job_price);
		}else{
			return redirect()->back();
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


	protected function show_job_detail_pending($id){
		if($id != null){
			$job = Job::find($id);
			if($job){
				$provider_conversation = Conversation::where('job_id', $job->id)
														->where('service_provider_id', Auth::id())->first();
      			return View::make('service_provider.jobs.job_overview_partial')->with('job', $job)->with('provider_conversation', $provider_conversation);
			}else{
				return redirect()->back();
			}
		}else{
			return redirect()->back();
		}
	}


	//the function below creates a conversation object without any job offer. 
	protected function create_conversation_without_offer(Request $request) {
		$input = (object) $request->all();
		$job = Job::find($input->job_id);
		$service_provider_id  = $input->service_provider_id;
		if($job != null && $service_provider_id != '') {
			if($job->status == "OPEN"){
				$conversation_exists = Conversation::where('job_id', $job->id)->where('service_provider_id', $service_provider_id)->first();
				if($conversation_exists == null) {
					$conversation = new Conversation();
					$conversation->job_id = $job->id;
					$conversation->service_provider_id = $service_provider_id;
					$conversation->status = "OPEN";
					$conversation->save();
				}
			}
		}
		return redirect()->back();
	}
	
	//make a job offer to service seeker job request. The job status must be OPEN.
	protected function make_offer(Request $request){
		$input = $request->all();
		$job_id = $input['job_id'];
		$job_offer = $input['job_offer'];
		$job_offer_description = $input['job_offer_description'];
		$job = Job::find($job_id);
		if($job_id != null && $job_offer != null){
			//make sure that the job exists	
			if($job->status != "APPROVED"){
				//check if there is an existing offer
				$conversation_exists = Conversation::where('job_id', $job_id)->where('service_provider_id', Auth::id())->first();
				if(!$conversation_exists){
					//create a new converstation
					$conversation = new Conversation();
					$conversation->job_id = $job_id;
					$conversation->service_provider_id = Auth::id();
					$conversation->status = "OPEN";
					$conversation->json = ["offer" => $job_offer, 'offer_description'=> $job_offer_description];
					if($conversation->save()){
						//$job->status = 'PENDING';
						//generate a message record
						$msg = new ConversationMessage();
						$msg->user_id = Auth::id();
						$msg->conversation_id = $conversation->id;
						$msg->text = 'Provider has sent you a job quote for $'.number_format($job_offer,2).'. Offer Description: '.$job_offer_description;
						$msg->msg_created_at = Carbon::now();
						$msg->save();
						if($job->save()){
							//email notification
							//$this->send_notification_job_quote_offer($job,$conversation);
							$title = 'New Message from your Service Provider - '.$conversation->service_provider_profile->first;
							$message = $msg->text;
							$this->send_user_mobile_notification($job->service_seeker_profile, $title, $message);
						}
					}
				}else{
					$conversation_exists->json = ["offer" => $job_offer, 'offer_description'=> $job_offer_description];
					$conversation_exists->status = 'OPEN';
					if($conversation_exists->save()){
						//$job->status = 'OPEN';
						//generate a message record
						$msg = new ConversationMessage();
						$msg->user_id = Auth::id();
						$msg->conversation_id = $conversation_exists->id;
						$msg->text = 'Provider has sent you a job quote for $'.number_format($job_offer,2).'. Offer Description: '.$job_offer_description;
						$msg->msg_created_at = Carbon::now();
						$msg->save();
						if($job->save()){
							//email notification
							//$this->send_notification_job_quote_offer($job,$conversation_exists);
							$title = 'New Message from your Service Provider - '.$conversation_exists->service_provider_profile->first;
							$message = $msg->text;
							$this->send_user_mobile_notification($job->service_seeker_profile, $title, $message);
						}
					}
				}
			}
		}
		return redirect()->back();
	}


    //check if the job offer exits for the logged in Service Provider
	protected function check_offer_exists(){
		$job_id = $_POST['job_id'];
		$response = false;
		if($job_id != null){
			$conversation = Conversation::where('job_id', $job_id)->where('service_provider_id', Auth::id())->first();
			if($conversation){
				$response = $conversation;
			}
		}
		return Response::json($response);
	}


	//check to see if the service provider offer has been accepted
	protected function check_if_offer_accepted(){
		$response = false;
		$job = Job::find($_POST['job_id']);
		if($job != null) {
			if($job->service_provider_id == Auth::id()) {
				$response = true;
			} 
		}
		return Response::json($response);
	}


	protected function show_job_conversation($job_id, $service_provider_id){
      //make sure the messages are in right order
	  $job = Job::find($job_id);
      $conversation = Conversation::where('job_id', $job_id)
						->where('service_provider_id', $service_provider_id)->first();
	  //find the sevrice seeker of this job and send info to blade view.
      $service_seeker_profile = User::find($job->service_seeker_id);
	
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
	  return View::make("service_provider.jobs.partial.job_converstation")
				  ->with('msgs',$conversation_messages)
				  ->with('conversation',$conversation)
				  ->with('job', $job)
				  ->with('service_seeker_profile', $service_seeker_profile);
    }


	protected function send_message(){
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
		  if($response) {
			//email notification
			//$this->send_notification_job_conversation_new_message($conversation,$message);
			$title = 'New Message from your Service Provider - '.$conversation->service_provider_profile->first;
			$message = $msg->text;
			$this->send_user_mobile_notification($conversation->job->service_seeker_profile, $title, $message);
		  }
	  }
      return Response::json($response);
    }


	protected function check_new_messages(){
		// if the chat is empty, then it throws error, because the page doesn't have any msgs blade variable.
		$response = false;
		$conversation_id = $_POST['conversation_id'];
		if(isset($_POST['msgs'])){
			$msgs = $_POST['msgs'];
			$last_msg = end($msgs);
			// return Response::json($last_msg);
			$last_msg_created_at = $last_msg['msg_created_at'];
		}else{
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
				$viewRendered = view('service_provider.jobs.partial.conversation_templates.job_conversation_messages_new', compact('msgs'))->render();
				return Response::json(['html'=>$viewRendered, 'msgs'=>$msgs]);

			}
	return Response::json($response);
	}


	protected function home_job_filter(){
		$input = $_POST['search'];
		$jobs = Job::where('title', 'LIKE', '%'.$input.'%')
								->orWhere('description', 'LIKE', '%'.$input.'%')
								->orWhere('job_date_time', 'LIKE', '%'.$input.'%')
								->get();
		$viewRendered = view('service_provider.home_job_template', compact('jobs'))->render();
		return Response::json(['html'=>$viewRendered, 'jobs' => $jobs]);
	}


	//important function to retrive service provider home job board page based on multiple parameters. Please care for sql bottleneck.
	protected function fetch_all_jobs(){
		$filter_action = $_POST['filter'];
		$user = Auth::user();	
		
		if($_POST['includes_keywords'] == '') {
			//based on distance 
			if($filter_action == 'DISTANCE') {
				$jobs = DB::table("jobs")
				->select("jobs.*" , "jobs.id as job_id"
					,DB::raw("6371 * acos(cos(radians(" . $_POST['current_lat'] . ")) 
					* cos(radians(jobs.job_lat)) 
					* cos(radians(jobs.job_lng) - radians(" . $_POST['current_lng'] . ")) 
					+ sin(radians(" .$_POST['current_lat']. ")) 
					* sin(radians(jobs.job_lat))) AS distance"))
					->where("jobs.status", "OPEN")
					->where("jobs.service_seeker_id", '!=', $user->id)
					->having('distance', '<=', $user->work_radius)
					->groupBy("job_id")
					->orderBy('distance', 'asc')
					->get();
			} else if ($filter_action == 'RECENT') {
				$jobs = DB::table("jobs")
				->select("jobs.*" , "jobs.id as job_id"
					,DB::raw("6371 * acos(cos(radians(" . $_POST['current_lat'] . ")) 
					* cos(radians(jobs.job_lat)) 
					* cos(radians(jobs.job_lng) - radians(" . $_POST['current_lng'] . ")) 
					+ sin(radians(" .$_POST['current_lat']. ")) 
					* sin(radians(jobs.job_lat))) AS distance"))
					->where("jobs.status", "OPEN")
					->where("jobs.service_seeker_id", '!=',  $user->id)
					->having('distance', '<=', $user->work_radius)
					->groupBy("job_id")
					->orderBy('created_at', 'desc')
					->get();
			} else {
				$jobs = DB::table("jobs")
				->select("jobs.*" , "jobs.id as job_id"
					,DB::raw("6371 * acos(cos(radians(" . $_POST['current_lat'] . ")) 
					* cos(radians(jobs.job_lat)) 
					* cos(radians(jobs.job_lng) - radians(" . $_POST['current_lng'] . ")) 
					+ sin(radians(" .$_POST['current_lat']. ")) 
					* sin(radians(jobs.job_lat))) AS distance"))
					->where("jobs.status", "OPEN")
					->where("jobs.service_seeker_id", '!=',  $user->id)
					->having('distance', '<=', $user->work_radius)
					->groupBy("job_id")
					->orderBy('jobs.created_at', 'asc')
					->get();
			}
		} else {
			//based on distance 
			if($filter_action == 'DISTANCE') {
				$jobs = DB::table("jobs")
				->select("jobs.*" , "jobs.id as job_id"
					,DB::raw("6371 * acos(cos(radians(" . $_POST['current_lat'] . ")) 
					* cos(radians(jobs.job_lat)) 
					* cos(radians(jobs.job_lng) - radians(" . $_POST['current_lng'] . ")) 
					+ sin(radians(" .$_POST['current_lat']. ")) 
					* sin(radians(jobs.job_lat))) AS distance"))
					->where("jobs.status", "OPEN")
					->where("jobs.service_seeker_id", '!=', $user->id)
					->where('jobs.title', 'like', '%'.$_POST['includes_keywords'].'%')
					->orwhere('jobs.description', 'like', '%'.$_POST['includes_keywords'].'%')
					->having('distance', '<=', $user->work_radius)
					->groupBy("job_id")
					->orderBy('distance', 'asc')
					->get();
			} else if ($filter_action == 'RECENT') {
				$jobs = DB::table("jobs")
				->select("jobs.*" , "jobs.id as job_id"
					,DB::raw("6371 * acos(cos(radians(" . $_POST['current_lat'] . ")) 
					* cos(radians(jobs.job_lat)) 
					* cos(radians(jobs.job_lng) - radians(" . $_POST['current_lng'] . ")) 
					+ sin(radians(" .$_POST['current_lat']. ")) 
					* sin(radians(jobs.job_lat))) AS distance"))
					->where("jobs.status", "OPEN")
					->where("jobs.service_seeker_id", '!=',  $user->id)
					->where('jobs.title', 'like', '%'.$_POST['includes_keywords'].'%')
					->orwhere('jobs.description', 'like', '%'.$_POST['includes_keywords'].'%')
					->having('distance', '<=', $user->work_radius)
					->groupBy("job_id")
					->orderBy('created_at', 'desc')
					->get();
			} else {
				$jobs = DB::table("jobs")
				->select("jobs.*" , "jobs.id as job_id"
					,DB::raw("6371 * acos(cos(radians(" . $_POST['current_lat'] . ")) 
					* cos(radians(jobs.job_lat)) 
					* cos(radians(jobs.job_lng) - radians(" . $_POST['current_lng'] . ")) 
					+ sin(radians(" .$_POST['current_lat']. ")) 
					* sin(radians(jobs.job_lat))) AS distance"))
					->where("jobs.status", "OPEN")
					->where("jobs.service_seeker_id", '!=',  $user->id)
					->where('jobs.title', 'like', '%'.$_POST['includes_keywords'].'%')
					->orwhere('jobs.description', 'like', '%'.$_POST['includes_keywords'].'%')
					->having('distance', '<=', $user->work_radius)
					->groupBy("job_id")
					->orderBy('jobs.created_at', 'asc')
					->get();
			}
		}	
		
		//$jobs  = Job::where('status', 'OPEN')->get();
		//render the html page.
		$viewRendered = view('service_provider.jobs.jobs_templates.jobs_homepgae_template_list', compact('jobs'))->render();
		return Response::json(['html'=>$viewRendered, 'jobs'=>$jobs]);
	}


    //change the job status to on trip
	function update_status_ontrip(){
		$job_id = $_POST['job_id'];
		//check if the the current user is the registered service provider for this job
		$job = Job::find($job_id);
		$response = false;
		//check if job is not open or cancelled
		if($job->status == 'APPROVED') {
			//check if the service provider offer is accepted
			$conversation = Conversation::where('job_id', $job->id)->where('service_provider_id', Auth::id())->first();
			if($conversation != null) {
				$job->status = 'ONTRIP';
				if($job->save()) {
					//app('App\Http\Controllers\JobNotificationController')->send_job_status_update_notification_to_service_seeker($job);
					$title = 'LocaL2LocaL - Job Status Updated';
					$message = 'The status of the job with id #'.$job->id.' has been changed to'.$job->status;
					$this->send_user_mobile_notification($conversation->job->service_seeker_profile, $title, $message);
					$response = true;
				}
			}
		}
		return Response::json($response);
	}


	//change the job status to on trip when user press cancelled button
	function update_status_cancelontrip(){
		$job_id = $_POST['job_id'];
		//check if the the current user is the registered service provider for this job
		$job = Job::find($job_id);
		$response = false;
		//check if job is not open or cancelled
		if($job->status == 'ONTRIP') {
			//check if the service provider offer is accepted
			$conversation = Conversation::where('job_id', $job->id)->where('service_provider_id', Auth::id())->first();
			if($conversation != null) {
				$job->status = 'APPROVED';
				if($job->save()) {
					$response = true;
					$title = 'LocaL2LocaL - Job has been cancelled.';
					$message = 'A job with id #'.$job->id.' has been cancelled by your Service Provider';
					$this->send_user_mobile_notification($job->service_seeker_profile, $title, $message);
				}
			}
		}
		return Response::json($response);
	}


	//change the job status to arrived when user press mark arrived button
	function update_status_mark_arrived(){
		$job_id = $_POST['job_id'];
		//check if the the current user is the registered service provider for this job
		$job = Job::find($job_id);
		$response = false;
		//check if job is not open or cancelled
		if($job->status == 'ONTRIP') {
			//check if the service provider offer is accepted
			$conversation = Conversation::where('job_id', $job->id)->where('service_provider_id', Auth::id())->first();
			if($conversation != null) {
				$job->status = 'ARRIVED';
				if($job->save()) {
					$response = true;
					$title = 'LocaL2LocaL - Service Provider Arrived.';
					$message = 'Service Provider has arrived for job with id #'.$job->id;
					$this->send_user_mobile_notification($job->service_seeker_profile, $title, $message);
				}
			}
		}
		return Response::json($response);
	}

	//change the job status to started when user enters a valid job pin
	function update_status_mark_started(Request $request) {
		$validator =  Validator::make($request->all(), [
			'pin_code_input' => 'required|min:4|max:4',
			'job_id' => 'required'
		]);
		if ($validator->fails()) {
			return redirect()
					->back()
					->withErrors($validator)
					->withInput();
		} else {
			$data =  (object) Input::all();
			$job = Job::find($data->job_id);
            if($job != null) {
				if($job->job_pin == $data->pin_code_input) {
					$job->status = 'STARTED';
					$job->save();
					$title = 'LocaL2LocaL - Job Started.';
					$message = 'Service Provider has started for job with id #'.$job->id;
					$this->send_user_mobile_notification($job->service_seeker_profile, $title, $message);
				} else {
					$validator->getMessageBag()->add('pin_code_input', 'The pin you have entered is invalid.');
				}
			} 
			return redirect()->back()->withInput()->withErrors($validator);
		}
	}

	//marks the job as completed
	function update_status_mark_completed(Request $request){
		$validator =  Validator::make($request->all(), [
			'started_job_id' => 'required'
		]);
		if ($validator->fails()) {
			return redirect()
					->back()
					->withErrors($validator)
					->withInput();
		} else {
			$data =  (object) Input::all();
			$job = Job::find($data->started_job_id);
            if($job ->status == 'STARTED') {
				$create_payment_record = $this->create_payment_record($job);
				if($create_payment_record) {
					$job->status = 'COMPLETED';
					$job->save();
					$title = 'LocaL2LocaL - Job Completed.';
					$message = 'Service Provider has completed for job with id #'.$job->id;
					$this->send_user_mobile_notification($job->service_seeker_profile, $title, $message);
					$title1 = 'LocaL2LocaL - Job Completed.';

					//change it 11/11/2020
					$message1 = 'Success! Time for your next job.';
					$this->send_user_mobile_notification($job->service_provider_profile, $title1, $message1);
					
					//return redirect()->route('service_provider_home');
				}
				
			} 
			return redirect()->back()->withInput()->withErrors($validator);
		}
	}


	function create_payment_record($job) {
		//set the resonse variable 
		$response = false;
		//load service provider profile
		$service_provider = $job->service_provider_profile;
		//find the existing payment source 
		$final_price = $this->calcualte_final_job_total($job->id);  
		//print('Final price is: '. $final_price);print('<br>');
		$service_fee_without_extras =    $this->calcualte_final_job_total_without_extras($job->id);    
		//print('Final price without extras is: '. $service_fee_without_extras);print('<br>');
		$service_fee_percentage = 0.00;
		//print('LocaL2LocaL service fee percentage is: '. $service_fee_percentage);print('<br>');
		$service_fee_price = ($service_fee_percentage/100)*$service_fee_without_extras;
		//print('LocaL2LocaL service fee price is: '. $service_fee_price);print('<br>');
		$is_gst_applicable = false;
		if($service_provider->business_info != null) {

			$is_gst_applicable = $service_provider->business_info->gst_enabled;
			//print('GST value in service provider profile is: '. $is_gst_applicable);print('<br>');

		}
		//print('Is GST applicable: '. $is_gst_applicable);print('<br>');
		$gst_fee_value = 0;


		if($is_gst_applicable) {
			$gst_fee_value = $final_price/11;
		}
		


		//print('Total GST payable on final price is: '. $gst_fee_value);print('<br>');
		$payable_job_final_value = $final_price;
		//print('Final amount payable by user: '. $payable_job_final_value);print('<br>');
		$service_provider_payment_amount_total = $final_price - $service_fee_price; 
		//print('Service Provider amount is: '. $service_provider_payment_amount_total);print('<br>');

		$payment_source = new JobPayment();
		$payment_source->job_id = $job->id;
		$payment_source->job_price = $final_price;
		$payment_source->payable_job_price = $payable_job_final_value;
		$payment_source->service_fee_percentage = $service_fee_percentage;
		$payment_source->service_fee_price = $service_fee_price;
		$payment_source->service_provider_gets = $service_provider_payment_amount_total;
		$payment_source->is_gst_applicable = $is_gst_applicable;
		$payment_source->gst_fee_value = $gst_fee_value;
		$payment_source->notes = 'INITIAL PAYMENT REQUIRED';
		$payment_source->status = 'UNPAID';
		if($payment_source->save()) {
			$response = true;
			$this->generate_service_provider_payment_record($service_provider,$payment_source,$job);
		}
	
		return $response;
	}

	protected function stripe_make_new_charge($payment_source,$payable_job_final_value,$job,$stripe_payment_customer_object){
		$response = false;
		try {
			\Stripe\Stripe::setApiKey(config('app.stripe_private_key'));
			$charge_response = \Stripe\Charge::create ( array (
						"amount" => $payable_job_final_value * 100,
						"currency" => "aud",
						"customer" => $stripe_payment_customer_object->stripe_payment_token_id,
						"description" => $job->id. '--'. $job->title,
						'receipt_email' => $job->service_seeker_profile->email,
						"capture" => true,
				) );
			  if($charge_response->id != '') {
				//record payment details
				$payment_source->payment_reference_number;
				$payment_source->payment_method = 'STRIPE';
				$payment_source->payable_job_price = $payable_job_final_value;
				$payment_source->notes = 'FINAL PAYMENT CHARGED BY LOCAL2LOCAL';
				$payment_source->status = 'PAID';
				$payment_source->save();
				$response = true;
			  }
		   }catch (\Stripe\Error\InvalidRequest $e){$response =  $e->getMessage();}
		   catch (\Stripe\Error\Card $e){$response =  $e->getMessage();}
		   catch (\Stripe\Error\Refund $e){$response =  $e->getMessage();}
		   catch (\Stripe\Error\Customer $e){$response =  $e->getMessage();}
		   catch (\Stripe\Error\Account $e){$response =  $e->getMessage();}
		   return $response;
	}

	//refund unused charge amount to stripe customer
	protected function stripe_refund_charge($charge_id){
		$response = false;
		try {
            \Stripe\Stripe::setApiKey(config('app.stripe_private_key'));
            $charge = \Stripe\Refund::create([
            'charge' => $charge_id,
            'reason' => 'requested_by_customer',
            ]);
            $response =  true;
        }
        catch (\Stripe\Error\InvalidRequest $e){$response =  $e->getMessage();}
        catch (\Stripe\Error\Card $e){$response =  $e->getMessage();}
        catch (\Stripe\Error\Refund $e){$response =  $e->getMessage();}
        catch (\Stripe\Error\Customer $e){$response =  $e->getMessage();}
        catch (\Stripe\Error\Account $e){$response =  $e->getMessage();}
		return $response;
	}


	//generate a payment to be paid log for service provider
	protected function generate_service_provider_payment_record($service_provider,$payment_source,$job) {
		$paylog = $job->job_paylog;
		if($paylog == null) {
			$paylog = new ServiceProviderPaylog();
			$paylog->job_id =  $job->id;
			$paylog->status = 'PENDING';
			$paylog->total_amount = $payment_source->service_provider_gets;
			$paylog->user_id = $service_provider->id;
			$paylog->save();
			//Log::info('Service Provider with id '.$service_provider->id.' paylog created for job'.$job->id);
		}
	}


	//capture stripe precharge
	//this function refunds the money to cleint payment account.
	function capture_stripe_precharge($charge_id,$description){
		$response = false;
		try {
			\Stripe\Stripe::setApiKey(config('app.stripe_private_key'));
			$charge = \Stripe\Charge::retrieve($charge_id);
			$charge->description = $description;
			$charge->capture();
			$response = true;
		}
		//catch all possible error and display them to client.
		catch (\Stripe\Error\InvalidRequest $e){print($e->getMessage());}
		catch (\Stripe\Error\Card $e){print($e->getMessage());}
		catch (\Stripe\Error\Customer $e){print($e->getMessage());}
		catch (\Stripe\Error\Account $e){print($e->getMessage());}
		return $response = true;
	}


    //calcuates final job total.
	function calcualte_final_job_total($job_id){
		$price = 0.00;
		$job = Job::find($job_id);
		//retirve the approved job conversation
		$conversation = Conversation::where('job_id', $job->id)
						->select('users.*', 'conversations.id as conversation_id', 'conversations.json', 'conversations.job_id', 'conversations.service_provider_id' )
						->join('users', 'conversations.service_provider_id', '=', 'users.id')
						->first();
		//load all the active job extras
		$job_extras = $job->extras->where('status', 'ACTIVE');
		$extras_total = $this->calculate_job_price($job_extras, $conversation);
		$price += $extras_total;
		return $price;
	}

	//calcuates final job total.
	function calcualte_final_job_total_without_extras($job_id){
		$price = 0.00;
		//retirve the approved job conversation
		$conversation = Conversation::where('job_id', $job_id)
						->select('users.*', 'conversations.id as conversation_id', 'conversations.json', 'conversations.job_id', 'conversations.service_provider_id' )
						->join('users', 'conversations.service_provider_id', '=', 'users.id')
						->first();
		$price += floatval($conversation->json['offer']);
		return $price;
	}
	
	//update service provider rating
	function update_rating(Request $request){
		$validator =  Validator::make($request->all(), [
			'rating_job_id' => 'required',
			'sp_rating_start_value' => 'required'
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
				$job->service_provider_rating = $data->sp_rating_start_value;
				$job->service_provider_comment = $data->sp_rating_description_value;
				$job->save();
				//return redirect()->route('service_provider_home');
			} 
			return redirect()->back()->withInput()->withErrors($validator);
		}	
	}

	//send an invocie to service provider account with onclick action
	function service_provider_email_invoice($id){
		$job = Job::find($id);
		$job->is_invoice_sent = true;
		$job->save();
		$job_extras = $job->extras->where('status', 'ACTIVE');
		$conversation = Conversation::where('job_id', $job->id)
		          ->select('users.*', 'conversations.id as conversation_id', 'conversations.json', 'conversations.job_id', 'conversations.service_provider_id' )
	              ->join('users', 'conversations.service_provider_id', '=', 'users.id')
				  ->first();
		$pdf = PDF::loadView('invoice.sp_invoice_template' , array('job_id' => $id));
		$temp_name = 'invoice_'.rand(1,1000).'.pdf';
		$dest_path = public_path().'/temp_invoice/'.$temp_name;
		$pdf->save($dest_path);
		//create a email notification object
		$temp = new \stdClass();
		$temp->file_name = $dest_path;
		$temp->user_name = $job->service_provider_profile->first;
		$user = User::find($job->service_provider_id);
		$user->notify(new ServiceProviderEmailInvoice($temp));
		if(file_exists($dest_path)){
            unlink($dest_path);
		}
		//send push notification for invoice delivery
		$this->send_user_mobile_notification($job->service_provider_profile, 'Invoice Delivered successfully','Invoice for job with id #'.$job->id.' delivered to your nominated email account.');
		Session::put('status', 'An email has been sent.');
		return redirect()->back();
	}
	
	//service provider job filter
	protected function filter_jobs(){
		$filter_action = $_POST['filter_action'];
		$user_id = Auth::id();
		if($filter_action == "ALL"){
			$jobs = Conversation::join('jobs', 'conversations.job_id', 'jobs.id')
								->where('conversations.service_provider_id', Auth::id())
								->where('jobs.status','!=', 'CANCELLED')
								->orderBy('jobs.job_date_time', 'asc')
								->get();
		}else{
			$jobs = Conversation::join('jobs', 'conversations.job_id', 'jobs.id')
								->where('conversations.service_provider_id', Auth::id())
								->where('jobs.status',$filter_action)
								->orderBy('jobs.job_date_time', 'asc')
							->get();
		}
		//render the html page.
		$viewRendered = view('service_provider.jobs.jobs_templates.jobs_templates_list')
						->with('jobs', $jobs)			
						->render();
		return Response::json(['html'=>$viewRendered, 'jobs'=>$jobs]);
	}

	//service provider cancel job handler
	function service_provider_job_cancel(Request $request) {
		$data =  (object) Input::all(); 
		$job = Job::find($data->sp_job_cancel_id);
		
		if($job != null) {
		  //charge any cancellation fee if applicable
		  $job->status = 'OPEN';
		  $job->service_provider_id = null;
		  $job->save();
		  //mark conversation between service provider and service seeker for this job as closed.
		  $conversation = Conversation::where('job_id', $job->id)->where('service_provider_id', Auth::id())->first();
		  $conversation->status = 'CLOSED';
		  $conversation->save();

		  //add a service provider cancellation record
		  $check_existing  = DB::table('service_provider_job_cancellations')->where('service_provider_id', Auth::id())->where('job_id', $job->id)->get();
		  if(count($check_existing) == 0) {
			DB::table('service_provider_job_cancellations')->insert(
				['job_id' => $job->id, 'service_provider_id' => Auth::id(), 'reason' => 'Default']
			);
		  }
		
		}
		return redirect()->route('service_provider_home');
	  }


	//notification functions below
	//job board notification
	// protected function send_notification_job_quote_offer($job,$conversation){
	// 	$user = User::find($job->service_seeker_id);
	// 	if($user != null) {
	// 		$service_provider_info = User::find($conversation->service_provider_id);
	// 		$data = new \stdClass();
	// 		$data->job_id = $job->id;
	// 		$data->service_seeker_name = $user->first;
	// 		$data->service_provider_name = $service_provider_info->first.' '.$service_provider_info->last;
	// 		$data->service_name = $job->service_category_name.'-'.$job->service_subcategory_name;
	// 		$data->offer = $conversation->json['offer'];
	// 		//email
	// 		$user->notify(new JobQuoteOfferSend($data));
	// 		//sms
	// 		//push notification
	// 	}
	// }

	// protected function send_notification_job_conversation_new_message($conversation,$message){
	// 	$user = User::find($conversation->job->service_seeker_id);
	// 	if($user != null) {
	// 		$service_provider_info = User::find($conversation->service_provider_id);
	// 		$data = new \stdClass();
	// 		$data->job_id = $conversation->job_id;
	// 		$data->service_seeker_name = $user->first;
	// 		$data->service_provider_name = $service_provider_info->first.' '.$service_provider_info->last;
	// 		$data->message = $message;
	// 		//email
	// 		$user->notify(new JobConversationNewMessageServiceProvider($data));
	// 		//sms
	// 		//push notification
	// 	}
	// }
  

	//service seeker accepts service provider job offer
	// protected function send_notification_job_offer_accepted($conversation){
	// 	$user = User::find($conversation->job->service_seeker_id);
	// 	if($user != null) {
	// 	$service_provider_info = User::find($conversation->service_provider_id);
	// 	$data = new \stdClass();
	// 	$data->job_id = $conversation->job_id;
	// 	$data->service_seeker_name = $user->first;
	// 	$data->service_provider_name = $service_provider_info->first;
	// 	$data->offer = $conversation->json['offer'];
	// 	//email
	// 	$service_provider_info->notify(new JobQuoteOfferAccepted($data));
	// 	//sms
	// 	//push notification
	// 	}
	// }
  
  
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
