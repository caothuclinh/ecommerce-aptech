<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $table = "bills";
    public function customer(){
    	return $this->belongsTo('App\Customer','id_customer','id');
    }
}
