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
use App\Notifications\SendSupportEmail;
use App\User;
use Carbon\Carbon;
use Validator;
use PDF;
use Session;
use DB;

class HelpdeskController extends Controller
{
    function send_support_email(Request $request){
        $validation = Validator::make($request->all(), [
            'support_type' => 'required',
            'support_message' => 'required|min:3'
           ]);
        if($validation->passes()){
            $input = $request->all();
            //send support notification
            $user = Auth::user();
            $user->support_type = $input['support_type'];
            $user->support_message = $input['support_message'];
            Notification::route('mail', 'info@local2local.com.au')
            ->notify(new SendSupportEmail($user));
            Session::put('status', 'Your response is recieved. One of our support team members will resolve your issue shortly.');
            return redirect()->back();
        } else {
            return redirect()
            ->back()
            ->withErrors($validation)
            ->withInput();
        }
    }
}
