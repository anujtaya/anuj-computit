<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Conversation;
use App\ConversationMessage;
use App\User;
use Auth;
use View;

class InboxController extends Controller
{
    public function main_view(){

      $conversation = Conversation::where('service_provider_id', Auth::id())->get();
      
      if(request()->route()->getName() == 'service_provider_inbox_conversation'){
        return View::make("service_provider.inbox.conversation_view")->with('conversation',$conversation);
      }
      else if(request()->route()->getName() == 'service_seeker_inbox_conversation'){
        return View::make("service_seeker.inbox.conversation_view")->with('conversation',$conversation);
      }
    }

    public function count_unread_message(){
      
      $conversationMessage = 0;
      
      $conversation = Conversation::select('id')->where('service_provider_id', Auth::id())->get();
      if(!empty($conversation)){
        $conversationMessage = ConversationMessage::whereIn('conversation_id', $conversation->pluck('id'))->where('user_id', '!=', Auth::id())->where('is_read', false)->count();
      }
      return json_encode(['count' => $conversationMessage]);
    }
}
