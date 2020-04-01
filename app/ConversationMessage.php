<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConversationMessage extends Model
{
    protected $casts = [
        'json' => 'array'
    ];

    protected $table = 'conversation_messages';

    public $timestamps = true;

    public function conversation(){
      return $this->belongsTo('App\Conversation', 'conversation_id', 'id');
    }
}
