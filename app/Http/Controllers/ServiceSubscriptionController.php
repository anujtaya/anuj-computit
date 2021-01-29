<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Validator;
use Auth;
use App\User;
use Session;
use Illuminate\Support\Facades\Hash;
use App\ServiceCategory;
use App\ServiceSubCategory;
use App\ServiceProviderServices;
use DB;
use Response;


class ServiceSubscriptionController extends Controller
{
    // function fetch_services_active(){
    //     $input = $_POST['search'];
    //     $services = Db::table('service_categories')
    //                 ->select('service_categories.service_name',
    //                 'service_subcategories.service_subname as service_minor_name'
    //                  ,'service_subcategories.id as minor_cat_id',
    //                   'service_categories.id as major_cat_id')
    //                 ->join('service_subcategories', 'service_subcategories.service_cat_id', '=', 'service_categories.id')
    //                 ->where('service_subcategories.service_subname', 'LIKE' ,  '%'.$input.'%')
    //                 ->orWhere('service_categories.service_name', 'LIKE' ,  '%'.$input.'%')
    //                 ->orderBy('service_subname', 'asc')
    //                 ->get();


    //     $user_services = User::find(Auth::id())->service_provider_services;
        
    //     $new_data = new \stdClass();
    //     $new_data->services = $services;
    //     $new_data->user_services = $user_services;
    //     return Response::json($new_data);
    // }

    function fetch_services_active(){
        $input = $_POST['service_cat_id'];
        $services = Db::table('service_categories')
                    ->select('service_categories.service_name',
                    'service_subcategories.service_subname as service_minor_name'
                     ,'service_subcategories.id as minor_cat_id',
                      'service_categories.id as major_cat_id')
                    ->join('service_subcategories', 'service_subcategories.service_cat_id', '=', 'service_categories.id')
                    ->where('service_categories.id',   $input)
                    ->orderBy('service_subname', 'asc')
                    ->get();


        $user_services = User::find(Auth::id())->service_provider_services;
        
        $new_data = new \stdClass();
        $new_data->services = $services;
        $new_data->user_services = $user_services;
        return Response::json($new_data);
    }

    function service_add(){
        $service_id = $_POST['service_id'];
        $check = ServiceProviderServices::where('user_id', Auth::id())->where('service_cat_id', $service_id)->get();
        if(count($check) > 0 ) {
            return Response::json('2');
        } else {
           $record =  new ServiceProviderServices();
           $record->user_id  = Auth::id();
           $record->service_cat_id = $service_id;
           if($record->save()){
                return Response::json(true);
           } else {
                return Response::json('2');
           }

        }
       
    }

    function service_remove(){
        $service_id = $_POST['service_id'];
        $service = User::find(Auth::id())->service_provider_services->where('service_cat_id', $service_id)->first();
      
        if($service != null  ) {
             $service_temp = ServiceProviderServices::find($service->id);
             if($service_temp->delete()) {
             return Response::json(true);
            } else {
                return Response::json("1");
            }
            
        } else {
            return Response::json('2');
        }
                
     
    }
}
