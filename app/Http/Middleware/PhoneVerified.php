<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PhoneVerified
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
      if(Auth::user()->is_verified){
        return $next($request);
      }else{
        return redirect()->route('user_verify_phone_send');
      }
    }
}
