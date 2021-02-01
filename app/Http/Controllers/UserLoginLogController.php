<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserLoginLog;
use Auth;
use DB;

class UserLoginLogController extends Controller
{
    function create(Request $requet) {
        $input = $request->all();
        dd($input);
    }
}
