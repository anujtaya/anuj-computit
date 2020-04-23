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
           

        }
    
      }
    
}
