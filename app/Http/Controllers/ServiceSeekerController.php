<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\User;
use App\ServiceSubCategory;
use App\ServiceCategory;
use App\Job;
use App\Rating;
use App\Conversation;
use DB;
use Response;
use Auth;
use Validator;
use Session;

class ServiceSeekerController extends Controller
{
  function service_seeker_home(){
      $categories = ServiceCategory::all();
      return View::make("service_seeker.service_seeker_home_1")->with('categories', $categories);
  }

  function service_seeker_service_provider_profile(){
      return View::make("service_seeker.jobs.job_service_provider_profile");
  }

  function service_seeker_profile(){
    //ratings needs to be implement on appropiate pages.
      $rating = Rating::where('user_id', Auth::id());
      return View::make("service_seeker.profile.index")->with('rating', $rating);
  }

  function service_seeker_more(){
    return View::make("service_seeker.more.index");
  }

  function service_seeker_more_help(){
      return View::make("service_seeker.more.help");
  }

  function service_seeker_more_faqs(){
      return View::make("service_seeker.more.faqs");
  }

  function service_seeker_more_wallet(){
      return View::make("service_seeker.more.wallet");
  }

  function service_seeker_messages(){

    $messages = Db::table('users')
                ->select('users.first as first',
                'users.last as last',
                'conversations.json as messages',
                'conversations.service_provider_id as service_provider_id',
                'conversations.id as conversation_id',
                'jobs.id as job_id')
                ->join('conversations', 'conversations.service_provider_id', '=', 'users.id')
                ->join('jobs', 'jobs.id', 'conversations.job_id')
                ->where('jobs.service_seeker_id', Auth::id())
                ->get();
    if(count($messages)){
      foreach($messages as $msg){
        $msg->messages = json_decode($msg->messages);
      }
    }

    return View::make('service_seeker.messages.index')->with('messages', $messages);
  }

  

    protected function fetch_service_sub_categories(){
        $response = false;
        $service_cat_id = $_POST['service_cat_id'];
        if($service_cat_id != null){
          $response = ServiceSubCategory::where('service_cat_id', $service_cat_id)->get();
        }
        return Response::json($response);
    }

    protected function update_preferences(){
        $user_preferences = json_decode($_POST['user_preferences']);
        $user = User::find(Auth::user()->id);
        $user->properties = $user_preferences;
        $response = $user->save();
        return Response::json($response);
      }

    protected function services_filter(){
      $search = $_POST['search'];

      $services = ServiceCategory::where('service_name', 'LIKE', '%'.$search.'%')->get();

      return Response::json($services);
    }

    protected function service_seeker_job_details_update(Request $request){
      $input = $request->all();
      $validation = Validator::make($request->all(), [
        'job_id' => 'required'
       ]);
       if($validation->passes()){
         $job = Job::find($input['job_id']);
         if($job){
           if($job->service_seeker_id == Auth::id()){
             $job->title = $input['job_title'];
             $job->description = $input['job_description'];
             $job->job_date_time = $input['job_date_time'];
             $response = $job->save();
             if($response){
               Session::put('status', 'Your profile has been successfully updated.');
               return redirect()->back();
             }else{
               Session::put('error', 'Unable to update your profile');
             }
           }else{
             abort(401,"");
           }
         }
       }else{
         // code for failed validation
       }
      return redirect()->back();
    }

    protected function show_message_offer(){
      $conversation_id = $_POST['conversation_id'];
      $data = array();
      if($conversation_id != null){
        $converstation = Conversation::find($conversation_id);
        $service_provider = User::find($converstation->service_provider_id);
      }else{
        abort(404);
      }

      $data['conversation'] = $converstation;
      $data['service_provider'] = $service_provider;


      return Response::json(json_encode($data));
    }
}
