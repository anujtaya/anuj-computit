<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Database\Eloquent\Collection;
use BayAreaWebPro\SimpleCsv\SimpleCsv;

class MarketingController extends Controller
{
    function home(){
        return view('admin_portal.modules.marketing.home');
    }

    function generate_user_list(Request $request) {
        $users = User::select(
            'email as Email', 
            'first as First Name',
            'last as Last Name'
        )->get();
        return SimpleCsv::download( $users, 'download.csv');
        dd($request);
    }
}
