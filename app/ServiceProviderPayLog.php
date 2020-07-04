<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProviderPayLog extends Model
{
    
    protected $table = 'service_provider_paylog';

    public function job(){
        return $this->belongsTo('App\Job', 'job_id', 'id');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
