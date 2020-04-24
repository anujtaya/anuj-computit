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
        print($request->has('registration_type')); 
        print('<br>The user registration process under development.');
        die();
        if($request->has('registration_type')){
           
            Session::put('is_sp_registration_required', true);
        }
        return View::make("auth.register.register");
      }
    
}
