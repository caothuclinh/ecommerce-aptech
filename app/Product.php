<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';
    public function loai_sp(){
    	return $this->belongsTo('App\ProductType','id_type','id');
    }
}
