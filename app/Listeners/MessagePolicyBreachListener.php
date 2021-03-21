<?php

namespace App\Listeners;

use App\Events\MessagePolicyBreachEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\MessagePolicyBreach;
use Session;
use App\UserLoginLog;
use App\User;
use Carbon\Carbon;
use App\Conversation;

class MessagePolicyBreachListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessagePolicyBreachEvent  $event
     * @return void
     */
    public function handle(MessagePolicyBreachEvent $event)
    {
        if (isset($event->event_data) && $event->event_data != null) {
            //create a message policy breach alert for admin console so admin can see it
            $conversation = Conversation::find($event->event_data->conversation_id);
            if($conversation != null) {
                $msg_breach_record = MessagePolicyBreach::where('conversation_id', $conversation->id)->first();
                if($msg_breach_record == null) {
                    $msg_breach_record = new MessagePolicyBreach();
                    $msg_breach_record->conversation_id = $conversation->id;
                    $msg_breach_record->status = 'OPEN';
                    $msg_breach_record->save();
                    //notify via push notification to admin
                    //send user mobile notification when login occurs except the people email listed in the exception array.
                    $marketing_user =  User::find(1910);
                    if($marketing_user != null ) {
                        app('App\Http\Controllers\NotificationController')->send_user_mobile_notification($marketing_user,'L2L Message Policy Breach Alert!','A new message policy breach is detected for conversation with id :#'.$event->event_data->conversation_id);
                       
                    }
                }
            }
        }
    }
}
