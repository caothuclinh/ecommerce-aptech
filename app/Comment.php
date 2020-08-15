<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    Protected $table = 'comments';
    public function user(){
    	return $this->belongsTo('App\User','id_user','id');
    }
}
