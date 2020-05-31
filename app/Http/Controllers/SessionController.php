<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    protected function set_user_offline_consent(Request $request){
        session()->push('user_offline_consent', 'true');
        return redirect()->back();
    }
}
