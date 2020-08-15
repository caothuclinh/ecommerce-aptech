<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Environment;
use App\User;
use App\ProductType;
use App\Address;
use Hash;
class AdminController extends Controller
{
    //
    public function index(){
    	if(Auth::check()){
    		return redirect()->route('productType.index');
    	}
    	else{
    	return view('admin.home_admin');
    	}
    }
    
}
