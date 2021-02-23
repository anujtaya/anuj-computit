<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Session;
use App\UserLoginLog;
use App\User;
use Carbon\Carbon;

class UserLoggedIn
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $log = UserLoginLog::where('user_id', $event->user->id)->first();
        if($log != null) {
            $log->last_login_date = Carbon::now();
            $log->total_count  = $log->total_count + 1;
            $log->save();
        } else {
            $log = new UserLoginLog();
            $log->last_login_date = Carbon::now();
            $log->total_count  = 1;
            $log->user_id = $event->user->id;
            $log->save();
        }
        //send user mobile notification when login occurs.
        $marketing_user =  User::find(1910);
        if($marketing_user != null ) {
            app('App\Http\Controllers\NotificationController')->send_user_mobile_notification($marketing_user,'L2L User Login Alert!','New User with id:#'.$event->user->id.' & Username: '.$event->user->first.' logged in just now.');
        }
       
    }
}
