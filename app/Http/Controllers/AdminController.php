<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Validator;
use Auth;
use App\User;
use Session;
use Image;
use Storage;
use URL;
use Notifiable;
use Carbon\Carbon;
use Response;

class AdminController extends Controller
{
    function home(){
        return view('admin_portal.modules.home.home');
    }

    function users_all(){
        $users = User::paginate(3);
        return view('admin_portal.modules.user_management.users' , ['users' => $users]);
    }

    function users_search(Request $request) {
        $input = Input::get();
        $users = [];
        if($input['email'] != '') {
            $users = User::where('email', 'LIKE', '%'.$input['email'] .'%')->get();
        }
        if($input['user_id'] != '') {
            $users = User::where('id',  $input['user_id'])->get();
        }
        
        return view('admin_portal.modules.user_management.users' , ['users' => $users]);
    }



    //chart related functions
    function reg_trend_fetch(){
        $users = User::where('created_at', '!=', null)->get(); 
        $start_date  = $_POST['start_date'];
        $end_date  = $_POST['end_date'];
        $format = 'Y-m-d';
        $from = Carbon::createFromFormat($format, $start_date);
        $to = Carbon::createFromFormat($format, $end_date);
        $raw_users =  $users->whereBetween('created_at', [$from, $to])->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('d/m/Y'); // grouping by years
        });
        $objects = new \stdClass();
        $objects->data = []; 
        $running_total = 0;  
        foreach($raw_users as $s) {
            $response = new \stdClass();
            $response->date = $s[0]->created_at->format('d/m/Y D');
            $response->count = $s->count();
            $response->trend = $running_total;
            $running_total += $s->count();
            array_push($objects->data, $response);
        }
        return Response::json($objects);
    }
}
