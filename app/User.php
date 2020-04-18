<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first', 'last',  'email', 'password','default_timezone','timezone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'properties' => 'array'
    ];

   
    public function business_info(){
        return $this->hasOne('App\BusinessInfo');
    }

    public function languages(){
        return $this->hasMany('App\ServiceProviderLangauge');
    }

    public function service_provider_services(){
        return $this->hasMany('App\ServiceProviderServices');
    }

    public function certificates(){
        return $this->hasMany('App\Certificate');
    }

    public function current_location(){
        return $this->hasOne('App\UserCurrentLocation');
    }

    public function service_provider_payment(){
        return $this->hasOne('App\ServiceProviderPayment');
    }
}
