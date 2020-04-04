<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //
	  protected $casts = [
        'json' => 'array'
    ];
  
    protected $table = 'conversations';

    public $timestamps = true;

    public function job(){
      return $this->belongsTo('App\Job', 'job_id', 'id');
    }

    public function conversation_messages(){
      return $this->hasMany('App\ConversationMessage', 'conversation_id', 'id');
    }

    public function service_provider_profile(){
      return $this->hasOne('App\User', 'id', 'service_provider_id');
    }

}
