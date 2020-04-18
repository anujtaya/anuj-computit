<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProviderPayment extends Model
{
    protected $table = 'service_provider_payments';
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
