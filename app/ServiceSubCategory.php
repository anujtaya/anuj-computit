<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ServiceSubCategory extends Model
{
  protected $table = 'service_subcategories';
    //
    public function service_category(){
      return $this->belongsTo('App\ServiceCategory', 'service_cat_id', 'id');
    }
}
