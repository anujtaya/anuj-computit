<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Notifiable;
use Validator;
use Input;
use App\User;
use URL;
use Auth;
use Session;
use Redirect;
use App\ServiceCategory;
use App\ServiceSubCategory;

class ServiceManagementController extends Controller
{
    //add catergory
    function add_category(Request $request){
        $input = Input::all();
        try {
            DB::table('service_categories')->insert([
                'service_name' => $input['name'],
                'is_active' => true,
            ]);
            Session::put('status', 'Added a new Service Category: '.$input['name']);
            return Redirect::back();
         }
         catch(\Illuminate\Database\QueryException $e){
            Session::put('error', $e->getMessage());
            return Redirect::back();
         }
      }

    //add catergory
    function add_sub_category(Request $request){
        $input = Input::all();
        try {
             DB::table('service_subcategories')->insert([
                'service_subname' => $input['minor_name'], 
                'service_cat_id' => $input['majorCat']
                ]);
              Session::put('status', 'Added a new Service Sub Category: '.$input['minor_name']);
              return Redirect::back();
         }
         catch(\Illuminate\Database\QueryException $e){
             Session::put('error', $e->getMessage());
              return Redirect::back();
         }
      }
  
    
    function display_admin_edit_view(){
        $major_categories = ServiceCategory::where('is_active', '!=', false)->orWhere('is_active', null)->orderBy('priority')->get();
        return view('admin_portal.modules.service_management.edit')->with('major_categories', $major_categories);
    }

    function update_major_priority_list(){
        $major_cat_list = $_POST['phases_priority_list'];
        for($i = 0; $i < sizeOf($major_cat_list); $i++)
        {
            DB::table('service_categories')->where('id', $major_cat_list[$i])->update(['priority' => $i+1]);
        }
        return Response::json(true);
    }

    function update_minor_priority_list(){
        $minor_cat_list = $_POST['phases_priority_list'];
        for($i = 0; $i < sizeOf($minor_cat_list); $i++)
        {
            DB::table('service_subcategories')->where('id', $minor_cat_list[$i])->update(['priority' => $i+1]);
        }
        return Response::json(true);
    }

    function update_major_name(){
        $value = $_POST['value'];
        $id = $_POST['id'];
       
        $service = ServiceCategory::find($id);
        $service->service_name = $value;
        $service->save();  
        return Response::json(true);
    }

    function update_minor_name(){
        $value = $_POST['value'];
        $id = $_POST['id'];
       
        $service = ServiceSubCategory::find($id);
        $service->service_subname = $value;
        $service->save();  
    }

    protected function fetch_minor_cat_list(){
        $cat_id = $_POST['cat_id'];
        $mncs = Db::table('service_subcategories')->where('service_cat_id', $cat_id)->orderBy('priority','asc')->get();
        return Response::json($mncs);
    }
}
