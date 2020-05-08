<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceSeekerStripePayment extends Model
{
    protected $table = "sss_payments";

    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function sss_payment_sources(){
        return $this->hasMany('App\ServiceseekerStripePaymentSource', 'sss_payment_id', 'id');
    }
}
