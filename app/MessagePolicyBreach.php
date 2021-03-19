<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessagePolicyBreach extends Model
{

    protected $table = 'message_policy_breachs';

    public $timestamps = true;

    public function conversation(){
        return $this->belongsTo('App\Conversation', 'conversation_id', 'id');
    }
}
