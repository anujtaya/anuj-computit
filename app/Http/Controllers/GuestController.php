<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    protected function mobile_landing_page(){
        return view('auth.mobile.getting_started');
    }

    protected function handle_landing_request(){
      if(Auth::check()){
        return redirect()->route('login');
      }else{
        return redirect()->route('guest_mobile_landing_page');
      }
    }

    protected function links(){
      return view('/links');
    }


}
