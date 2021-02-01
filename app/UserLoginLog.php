<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLoginLog extends Model
{
    protected $table = 'userloginlogs';

    public $timestamps = true;
    
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
