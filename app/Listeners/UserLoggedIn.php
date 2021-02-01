<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Session;
use App\UserLoginLog;
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
    }
}
