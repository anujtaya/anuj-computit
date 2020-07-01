<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceseekerStripePaymentSource extends Model
{
    protected $table = "sss_payment_sources";

    public $timestamps = true;

    public function service_seeker_payment(){
        return $this->belongsTo('App\ServiceSeekerStripePayment', 'sss_payment_id', 'id');
    }
}
