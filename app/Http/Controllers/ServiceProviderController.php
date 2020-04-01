<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Job;
use App\Bid;
use App\Conversation;
use App\ConversationMessage;
use Auth;
use Response;

class ServiceProviderController extends Controller
{
    function home(){
		// SULTAN - HOME - SERVICE PROVIDER HOME FUNCTION
		// At the moment retrieve all jobs. But on the production version, show 10 or 15 jobs, and then when user scrolls down retrieve more jobs.
		// Also, get most recently posted jobs
		$jobs = Job::where('status', '!=', 'DRAFT')->get();
        return view('service_provider.home')->with('jobs', $jobs);
    }

    function  registration_completed(){
        return view('service_provider.registration_completed');
    }

    function service_provider_profile_nested(){
        $certificates = Auth::user()->certificates;
        $languages =  Auth::user()->languages;
        $user_services = Auth::user()->service_provider_services;
        dd($user_services);
        return View::make("service_provider.profile.nested.index")->with('certificates', $certificates)->with('current_languages', $languages);
    }

    function service_provider_profile_edit(){
        return View::make("service_provider.profile.index");
    }

    //add service provider services preferences
    function service_provider_update_service_preferences(){
        return View::make("service_provider.profile.nested.add_services_partial");
    }

    //add service provider certificates preferences
    function service_provider_update_certificate_preferences(){
        $certificates = Auth::user()->certificates;
        return view("service_provider.profile.nested.add_certificates_partial")->with('certificates', $certificates);
    }

    //add service provider certificates preferences
    function service_provider_update_languages_preferences(){
        $languages =  Auth::user()->languages;
        return view("service_provider.profile.nested.add_languages_partial")->with('current_languages', $languages);
    }

    function service_provider_more(){
        return View::make("service_provider.more.index");
    }

    function service_provider_more_help(){
        return View::make("service_provider.more.help");
    }

    function service_provider_more_faqs(){
        return View::make("service_provider.more.faqs");
    }

    function service_provider_more_wallet(){
        return View::make("service_provider.more.wallet");
    }


    function service_provider_jobs_history(){
        //need to be changed to service_provider_id
        //$service_provider_jobs = Job::where('service_seeker_id', Auth::id())->where('status', '!=', 'OPEN')->where('status', '!=', 'COMPLETED')->where('status', '!=', 'CANCELED')->get();
        
        // $convos = Conversation::where('service_provider_id', Auth::id())->get();
        $service_provider_jobs = Conversation::join('jobs', 'conversations.job_id', 'jobs.id')
                                ->where('conversations.service_provider_id', Auth::id())
                                ->where('jobs.status','!=' , 'DRAFT')
                                ->where('jobs.status','!=' , 'COMPLETED')
                                ->get();
        //dd($service_provider_jobs);
        return View::make("service_provider.jobs.history")->with('service_provider_jobs', $service_provider_jobs);
    }


    function service_provider_jobs_full_history(){
        $service_provider_jobs = Job::where('service_provider_id', Auth::id())->where('status', '!=', 'CANCELED')->get();
        return View::make("service_provider.jobs.full_history")->with('service_provider_jobs', $service_provider_jobs);
    }

    
}
