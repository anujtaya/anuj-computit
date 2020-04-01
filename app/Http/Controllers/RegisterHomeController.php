<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\User;
use Auth;
use Session;

class RegisterHomeController extends Controller
{
    
    //common for both service provider and service seeker registation. Includes primary account registration and phone verification
    function register(Request $request){
        $input = $request->all()['registration_type'];
         if($input == 'sp'){
            Session::put('is_sp_registration_required', true);
        }
        return redirect()->route('register_1');
      }
    
    function register_step_1(){
        return View::make("auth.register.register_1");
    }

    function register_step_2(){
        return View::make("auth.register.register_2");
    }

    function register_step_3(){
        return View::make("auth.register.register_3");
    }

    function register_step_4(){
        return View::make("auth.register.register_4");
    }

}
