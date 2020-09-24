<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //copied from previous versions of LocaL2LocaL application
        '/notify',
        '/serviceLatLng',
        '/android_login',
        '/notifyAndro',
        '/serviceLatLng2',
        '/addRating',
        '/save_android_token'
    ];
}
