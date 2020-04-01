<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobExtra extends Model
{
    protected $table = 'job_extras';
    public $timestamps = true;
    
    public function job(){
        return $this->belongsTo('App\Job', 'job_id', 'id');
    }
}
