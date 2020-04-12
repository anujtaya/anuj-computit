<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCurrentLocation extends Model
{
  protected $table = 'user_current_locations';

  public $timestamps = true;

  public function user(){
        return $this->belongsTo('App\User');
      }
}
