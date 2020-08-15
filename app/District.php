<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    protected $table = 'devvn_quanhuyen';
    public function city(){
    	return $this->belongsTo('App\City','id_thanhpho','matp');
    }
    public function ward(){
    	return $this->hasMany('App\Ward','id_quanhuyen','maqh');
    }
}
