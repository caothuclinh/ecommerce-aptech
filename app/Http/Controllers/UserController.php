<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use User;

class UserController extends Controller
{
    //
    public function postLogin(Request $req){
    	$this->validate($req, 
    		[
    			'email' => 'required|email',
    			'password' => 'required'
    		],
    		[	
    			'email.required' => 'email không được để trống',
    			'email.email' => 'không đúng địng dạng email',
    			'password.required' => 'mật khẩu không được để trống'
    		]
    	);
    	$credentials = array('email' => $req->email,'password' => $req->password);
    	if(Auth::attempt($credentials)){
    		if(Auth::user()->power == 1){
    		return redirect()->route('productType.index');
    		}
    		elseif(Auth::user()->power != 1){
    			return redirect()->back()->with('thongbao', 'tài khoản hoặc mật khẩu không chính xác');
    		}
    	}
    	else{
    		return redirect()->back()->with('thongbao', 'tài khoản hoặc mật khẩu không chính xác');
    	}
    }
    
}
