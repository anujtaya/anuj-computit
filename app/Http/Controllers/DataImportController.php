<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Notifications\AccountCreated;
use App\Job;
use DB;
use Illuminate\Database\Eloquent\Collection;
use SimpleCsv;

class DataImportController extends Controller
{
    function index(){
        return view('admin_portal.modules.data.index');
    }

    
    
    //import user into the system.
    function import_users(Request $request){
        $input = (object) $request->all();

        $users = DB::connection('mysql2')->table('users')->select('id','firstName','lastName','abn','phone','email','lat','lng','onService','isVerified','status', 'role', 'userImage','password','created_at','updated_at')->take(40)->get();
        foreach($users as $user) {
            $new_user = new User();
            $new_user->first = $user->firstName;
            $new_user->last = $user->lastName;
            $new_user->email = $user->email;
            $new_user->phone = $user->phone;
            $new_user->user_type = $user->role;
            if($user->password != null) {
                $new_user->password = $user->password;
            }
            $new_user->user_lat = $user->lat;
            $new_user->user_lng = $user->lng;
            $new_user->is_online = $user->onService;
            $new_user->status = $user->status;
            $new_user->is_verified = $user->isVerified;
            $new_user->profile_image_path = $user->userImage;
            $new_user->created_at = $user->created_at;
            $new_user->updated_at = $user->updated_at;
            $new_user->save();

        }
        dd('All user acount created successfully');
    }

    //generate a old user csv file
    function genrate_csv_file(Request $request){
        $input = (object) $request->all();

        $users = DB::connection('mysql2')->table('users')->select('id','firstName','lastName','abn','phone','email','lat','lng','onService','isVerified','status', 'role', 'userImage','password','created_at','updated_at')->get();
        $file_path = "/public/exports/old_l2l_users.csv";
        $exporter = SimpleCsv::export($users);
        $exporter->save(storage_path('app/'.$file_path));
        dd(true);
        //$exporter = SimpleCsv::export($collection);
        dd($users);
    }


}
