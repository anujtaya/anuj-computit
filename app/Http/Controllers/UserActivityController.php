<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use UserActivity;
use Carbon\Carbon;

class UserActivityController extends Controller
{
    function create($data){
        $activity = new UserActivity();
        $activity->user_id = $data->user_id;
        $activity->payload = $data->payload;
        $activity->created_at = $data->created_at;
        if($activity->save()){
            return true;
        } else {
            return false;
        }
    }
}
