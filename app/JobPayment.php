<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobPayment extends Model
{
    public function job(){
        return $this->belongsTo('App\Job', 'job_id', 'id');
    }
}
