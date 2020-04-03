<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProviderServices extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
      }

    public function service_sub_cat(){
      return $this->belongsTo('App\ServiceSubCategory', 'service_cat_id', 'id');
    }
}
