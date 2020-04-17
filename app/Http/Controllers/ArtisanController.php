<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtisanController extends Controller
{
    function clear_log(){
        $response = file_put_contents(storage_path('logs/laravel.log'),'');
        dd($response);
    }
}
