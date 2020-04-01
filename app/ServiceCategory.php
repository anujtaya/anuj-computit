<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $table = 'service_categories';
    //
    public function service_sub_categories(){
      return $this->hasMany('App\ServiceSubCategory', 'service_cat_id', 'id');
    }
}
