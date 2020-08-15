<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $table = 'devvn_tinhthanhpho';
    public function district(){
    	return $this->hasMany('App\District','id_thanhpho','matp');
    }
}
