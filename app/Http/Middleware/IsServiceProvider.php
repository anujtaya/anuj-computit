<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsServiceProvider
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
      if(Auth::user()->user_type == 1){
        return $next($request);
      }else{
        return redirect()->route('service_provider_register_business');
      }
    }
}
