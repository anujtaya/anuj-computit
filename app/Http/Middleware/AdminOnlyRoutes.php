<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminOnlyRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admins = array("tayaanuj@gmail.com", "peter.stack@computit.com.au", "karen@local2local.com.au","admin@local2local.com.au","marketing@local2local.com.au");
        if (in_array(Auth::user()->email, $admins)) {
             return $next($request);
        } else {
             abort(403, 'Security Exception - You are not authrized to access this resource!');
        }
    }
}
