<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\User;
use App\ServiceCategory;
use Auth;
use Session;

class GuestController extends Controller
{

    //display the application landing page
    protected function mobile_landing_page(){
      return view('auth.mobile.getting_started');
    }

    
    //redirect user based on auth status
    protected function handle_landing_request(){
      if(Auth::check()){
        return redirect()->route('login');
      } else{
        return redirect()->route('guest_mobile_landing_page');
      }
    }


    //handle request based on user selection of seeker demo or provider demo accounts
    protected function handle_guest_register_request(Request $request){
      $input = $request->all()['demo_type'];
      //dd($input);
      if($input == 'sp'){
        return View::make("service_provider.demo.tutorial");
      } else{
        return View::make("service_seeker.demo.tutorial");
      }
    }


    //service seeker home page query handler
    protected function service_seeker_home(Request $request) {
      $categories = ServiceCategory::all();
      if($request->has('showBooking')){
        //if the request has show booking paramenter than display the job booking page.
        return view("service_seeker.demo.home_2")->with('categories', $categories);
      } else {
        //show the default guest homepage for service seeker.
        $service_categories = $categories->pluck('service_name');
        return view("service_seeker.demo.home_1")->with('categories', $service_categories);
      }
    }

}
