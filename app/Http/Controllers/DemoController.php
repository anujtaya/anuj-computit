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
use DB;
use App\Notification;
use App\Notifications\AccountCreated;

class DemoController extends Controller
{
    
    function test_email(){
           $user = User::where('email', 'tayaanuj@gmail.com')->first();
           $user->notify(new AccountCreated($user->first));
    }
    
    
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

    function test_ss_invoice_template_design($id) {
        return view('invoice.ss_invoice_template')->with('job_id', $id);
    }


    function dump_database(){
        $get_all_table_query = "SHOW TABLES";
       // $result = DB::select(DB::raw($get_all_table_query));


        $result = DB::table("migrations")->get();


        $tables = [];
    
        foreach($result as $r) {
            $table_name = $this->string_between_two_string($r->migration, 'create_', '_table');
            array_push($tables,  $table_name);  
         
  

        }
        $structure = '';
        $data = '';
        foreach ($tables as $table) {
            $show_table_query = "SHOW CREATE TABLE " . $table . "";
    
            $show_table_result = DB::select(DB::raw($show_table_query));
    
            foreach ($show_table_result as $show_table_row) {
                $show_table_row = (array)$show_table_row;
                $structure .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
            }
            $select_query = "SELECT * FROM " . $table;
            $records = DB::select(DB::raw($select_query));
    
            foreach ($records as $record) {
                $record = (array)$record;
                $table_column_array = array_keys($record);
                foreach ($table_column_array as $key => $name) {
                    $table_column_array[$key] = '`' . $table_column_array[$key] . '`';
                }
    
                $table_value_array = array_values($record);
                $data .= "\nINSERT INTO $table (";
    
                $data .= "" . implode(", ", $table_column_array) . ") VALUES \n";
    
                $data .= "('" . implode("','", $table_value_array) . "');\n";
            }
        }
        $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
        $file_handle = fopen($file_name, 'w + ');
    
        $output = $structure . $data;
        fwrite($file_handle, $output);
        fclose($file_handle);
    }

    function string_between_two_string($str, $starting_word, $ending_word) 
    { 
        $subtring_start = strpos($str, $starting_word); 
        //Adding the strating index of the strating word to  
        //its length would give its ending index 
        $subtring_start += strlen($starting_word);   
        //Length of our required sub string 
        $size = strpos($str, $ending_word, $subtring_start) - $subtring_start;   
        // Return the substring from the index substring_start of length size  
        return substr($str, $subtring_start, $size);   
    }

    function button_demo(){
        return view('demo.button_demo');
    }
}
