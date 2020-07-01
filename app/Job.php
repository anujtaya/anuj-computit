<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
  
    public function conversations(){
      return $this->hasMany('App\Conversation', 'job_id', 'id');
    }

    public function service_seeker_profile(){
      return $this->hasOne('App\User', 'id', 'service_seeker_id');
    }

    public function service_provider_profile(){
      return $this->hasOne('App\User', 'id', 'service_provider_id');
    }

    public function attachments(){
      return $this->hasMany('App\JobAttachment');
    }

    public function extras(){
      return $this->hasMany('App\JobExtra');
    }

    public function job_payments(){
      return $this->hasOne('App\JobPayment');
    }
   
}
