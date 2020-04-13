<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;

class StripeConnectController extends Controller
{
    protected function store_stripe_connect_account(Request $request) {
        $input = Input::all();


        \Stripe\Stripe::setApiKey('sk_test_nsNpXzwR8VngENyceQiFTkdX00Tdv3sLsm');

        $response = \Stripe\OAuth::token([
        'grant_type' => 'authorization_code',
        'code' => $input['code'],
        ]);

        // Access the connected account id in the response
        $connected_account_id = $response->stripe_user_id;


        dd($connected_account_id);
    }
}
