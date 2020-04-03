<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\BusinessInfo;
use App\JobAttachment;
use App\Job;
use Session;
use Auth;
use View;
use Input;
use Validator;
use Response;

class DemoController extends Controller
{
    function car_map_demo(){
        return View::make("demo.car_map_demo");
    }

    function create_demo_jobs(){
        $job = new Job();
        $job->title = 'Sample job title'.rand(1,1000);
        $job->description = 'Sample decription';
        $job->job_date_time = \Carbon\Carbon::now()->addDays(2);
        $job->service_seeker_id = 1;
        $job->street_number = '54';
        $job->street_name =  'Jephson Street';
        $job->state =  'Queensland';
        $job->postcode =  '4066';
        $job->city =  'Brisbane City';
        $job->service_category_id =  1;
        $job->service_category_name ='Boat and Jetski';
        $job->service_subcategory_name = 'Detailing';
        $job->service_subcategory_id = 1;
        $job->job_lat = '-27.484616';
        $job->job_lng =  '152.990959';
        $job->status = "OPEN";
        //$job->service_provider_id = Auth::id();
        $job->service_seeker_rating = rand(1,5);
        //$job->status = 'CANCELLED';
        $job->job_pin = mt_rand(1000,9999);
        $job->save();
        print_r('A job has been created with id: '.$job->id);
        die();
    }

    function test_sp_invoice_template_design($id) {
        return view('invoice.sp_invoice_template')->with('job_id', $id);
    }

    
}
