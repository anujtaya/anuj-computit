<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class NotificationController extends Controller
{
    //user mobile notification routes
    function send_user_mobile_notification($user, $title, $message) {
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
                //Session::put('success', 'Mobile nottification sent successfully and token is updated.');
            }
        } 
    } 
    return $response;
    
  }
  
}
