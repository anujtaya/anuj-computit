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
use App\User;
use Carbon\Carbon;
use Input;
use Validator;
use PDF;
use Session;
use DB;

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
						$job->save();
					}
				}else{
					$conversation_exists->json = ["offer" => $job_offer, 'offer_description'=> $job_offer_description];
					$conversation_exists->status = 'OPEN';
					if($conversation_exists->save()){
						//$job->status = 'OPEN';
						$job->save();
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


	protected function show_job_conversation($job_id, $service_provider_id){
      //make sure the messages are in right order
	  $job = Job::find($job_id);
      $conversation = Conversation::where('job_id', $job_id)
						->where('service_provider_id', $service_provider_id)->first();
	  //find the sevrice seeker of this job and send info to blade view.
      $service_seeker_profile = User::find($job->service_seeker_id);
	
      $conversation_messages = Conversation::where('job_id', $job_id)
                            ->where('service_provider_id', $service_provider_id)
                            ->join('conversation_messages', 'conversation_messages.conversation_id', 'conversations.id')
                            ->join('users', 'users.id', 'conversation_messages.user_id')
                            ->orderBy('conversation_messages.msg_created_at', 'ASC')
							->get();
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
		  $receiver_id = Auth::user()->id;
		  $conversation = Conversation::where('id',$conversation_id)->first();
		  $msg = new ConversationMessage();
		  $msg->user_id = Auth::id();
		  $msg->conversation_id = $conversation->id;
		  $msg->text = $message;
		  $msg->msg_created_at = Carbon::now();
		  $response = $msg->save();
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
		$filter_action = $_POST['filter_action'];
		$user = Auth::user();	
		//based on user 
		//based on user distance from current location
		$jobs = DB::table("jobs")
			->select("jobs.*" , "jobs.id as job_id"
				,DB::raw("6371 * acos(cos(radians(" . $_POST['current_lat'] . ")) 
				* cos(radians(jobs.job_lat)) 
				* cos(radians(jobs.job_lng) - radians(" . $_POST['current_lng'] . ")) 
				+ sin(radians(" .$_POST['current_lat']. ")) 
				* sin(radians(jobs.job_lat))) AS distance"))
				->where("jobs.status", "OPEN")
				->having('distance', '<=', $user->work_radius)
				->groupBy("job_id")
				->orderBy('distance', 'asc')
				->get();
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
					app('App\Http\Controllers\JobNotificationController')->send_job_status_update_notification_to_service_seeker($job);
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
				//calcualte job total
				//charge the service to service provider
				$create_payment_record = $this->charge_job_payment($job);
				$job->status = 'COMPLETED';
				$job->save();
				//send invoice for both Service Provder and Service Seeker.
				//Send Push notification for Service completion.
				//send an email to local2local admin about a completed job.
			} 
			return redirect()->back()->withInput()->withErrors($validator);
		}
	}


	function charge_job_payment($job) {
		//set the resonse variable 
		$response = false;
		//find the existing payment source 
		$payment_source = $job->job_payment;
		if($payment_source == null) {
			$final_price = $this->calcualte_final_job_total($job->id);  
			$service_fee_without_extras =    $this->calcualte_final_job_total_without_extras($job->id);                        
			//credit card surcharges if paid using card
			//clacualte the local2local service fee price
			$service_fee_percentage = 12.00;
			$service_fee_price = round(round((($service_fee_percentage/100)*$service_fee_without_extras),2),2);    
			$is_gst_applicable = true;
			$gst_fee_value = round(($final_price/11),2);
			$payable_job_final_value = $final_price + $gst_fee_value;
			$service_provider_payment_amount_total = $payable_job_final_value - $service_fee_price;   
			$new_charge = new JobPayment();
			$new_charge->job_id = $job->id;
			$new_charge->payment_reference_number = 'NA';
			$new_charge->payment_method = 'CASH';
			$new_charge->job_price = $final_price;
			$new_charge->payable_job_price = $payable_job_final_value;
			$new_charge->service_fee_percentage = $service_fee_percentage;
			$new_charge->service_fee_price = $service_fee_price;
			$new_charge->service_provider_gets = $service_provider_payment_amount_total;
			$new_charge->is_gst_applicable = $is_gst_applicable;
			$new_charge->gst_fee_value = $gst_fee_value;
			$new_charge->notes = 'PAYMENT PAID ON TIME';
			$new_charge->status = 'PAID';
			if($new_charge->save()){
				$response = true;
			}
		}
		return $response;
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
			} 
			return redirect()->back()->withInput()->withErrors($validator);
		}	
	}

	//send an invocie to service provider account with onclick action
	function service_provider_email_invoice($id){
		$job = Job::find($id);
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
		$user = User::find($job->service_provider_id);
		$user->notify(new ServiceProviderEmailInvoice($temp));
		if(file_exists($dest_path)){
            unlink($dest_path);
        }
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
		$viewRendered = view('service_provider.jobs.jobs_templates.jobs_templates_list', compact('jobs'))->render();
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
				['job_id' => $job->id, 'service_provider_id' => Auth::id(), 'reason' => $data->reason]
			);
		  }
		
		}
		return redirect()->route('service_provider_home');
	  }


}
