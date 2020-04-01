<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Job;
use Auth;
use DB;
use App\Rating;

class JobController extends Controller
{

    //
    //user rating functions
  function addRating(){
          $uID_t = json_decode($_POST['type']); //0for service provider and 1 for client.
          $sID = json_decode($_POST['service_id']);
          $r = json_decode($_POST['rating']);
          $response = false;
          if($uID_t === 0 && is_numeric($r) ){
            // $job  = DB::table('active_jobs')->where('id',$sID)->update(['client_rating' => $r ]);
            //  return Response::json('Client Rating Updated');

            // needs to be changed
          }
          else if($uID_t === 1 && is_numeric($r) ){
            // $job  = DB::table('active_jobs')->where('id',$sID)->update(['sp_rating' => $r]); //mark job as completed
            //  return Response::json("Service Provider Rating Updated");
            $rating = Rating::where('user_id',Auth::id())->first();
            if($rating){
              $rating->star = $r;
              $response = $rating->save();
            }else{
              // needs to be changed
              $rating = new Rating();
              $rating->star = $r;
              $rating->service_id = $sID;
              $rating->user_id = Auth::id();
              $response = $rating->save();
            }


            if($response){
              return Response::json('Client rating saved.');
            }
          }
           else{
             return Response::json('Server Error');
          }
     }

}
