<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function homepage(){
        return view('frontend.homepage');
    }

    function faq(){
        return view('frontend.faq');
    }

    function support(){
        return view('frontend.support');
    }
   
}
