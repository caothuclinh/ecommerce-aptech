<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    //
    protected $table = 'product_types';
    public function sanpham(){
    	return $this->hasMany('App\Product','id_type','id');
    }
}
