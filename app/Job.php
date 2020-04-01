<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
  
    public function conversations(){
      return $this->hasMany('App\Conversation', 'job_id', 'id');
    }

    public function attachments(){
      return $this->hasMany('App\JobAttachment');
    }

    public function extras(){
      return $this->hasMany('App\JobExtra');
    }

    public function job_payment(){
      return $this->hasOne('App\JobPayment');
    }
   
}
