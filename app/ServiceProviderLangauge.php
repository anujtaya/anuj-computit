<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProviderLangauge extends Model
{
    protected $table = 'service_provider_langauges';

    public function user(){
        return $this->belongsTo('App\User');
      }
}
