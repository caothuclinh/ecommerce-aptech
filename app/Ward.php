<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    //
    protected $table = 'devvn_xaphuongthitran';
    public function quanhuyen(){
    	return $this->belongsTo('App\District','id_quanhuyen','maqh');
	}
}
