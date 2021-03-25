<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessagePolicyBreachEvent;
use App\Job;
use App\Conversation;
use App\ConversationMessage;
use App\User;
use Auth;
use Response;
use Carbon\Carbon;
use Session;


class PolicyController extends Controller
{
    function generate_security_policy_breah_event(){
        //extract conversation id
        $conversation_id = $_POST['conversation_id'];
        //extract the message
        $message = $_POST['message'];
        $user_id = $_POST['user_id'];
        $source = $_POST['source'];
        $data = new \stdClass();
        $data->conversation_id = $conversation_id;
        $data->user_id = $user_id;
        $data->message = $message;
        $data->source = $source;
        event(new MessagePolicyBreachEvent($data));
        //generate alert
        return Response::json('Admin message policy breach alert generated!');
    }
}
