<?php

namespace App;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    //
    use AuthenticableTrait;
    public function comment(){
    	return $this->hasMany('App\Comment','id_user','id');
    }
}
