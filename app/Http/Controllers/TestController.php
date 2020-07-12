<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Input;
use Validator;
use Auth;
use App\User;
use Session;
use Illuminate\Support\Facades\Hash;
use Image;
use Storage;
use URL;
use Notifiable;
use App\Notification;
use App\Notifications\AccountCreated;

class TestController extends Controller
{
    function test() {
        return view('test.test');
    }
}
