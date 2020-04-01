<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserAcitivity;
use Auth;
use Response;
use DB;

class UserHomeController extends Controller
{
    function display_home_page(Request $request){
        $user = User::findorfail(Auth::id());
        return view('home');
    }

    function display_account_page(){
        $user = User::findorfail(Auth::id());
        $activities = $user->user_activities;
        return view('user.pages.account')->with('activities', $activities);
    }

}
