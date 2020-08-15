<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Environment;
use App\User;
use App\Address;
use Hash;
use App\ProductType;
use App\Product;
use App\Comment;
use Session;
use App\Cart;
class PageController extends Controller
{
    //
    public function index(){

        $sp_moi = Product::where('new','1')->inRandomOrder()->paginate(6);
        $sp_khuyenmai = Product::where('promotion_price','<>',0)->inRandomOrder()->paginate(3);
        $sp_khac = Product::orderby('id','ASC')->paginate(6);
    	return view('show_view.pages.index',compact('sp_moi','sp_khuyenmai','sp_khac'));
    }
    public function getSignin(){
    	return view('show_view.pages.dangky');
    }
    public function getLogin(){
    	return view('show_view.pages.dangnhap');
    }
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
            if (Auth::user()->power != '1') {
                
    		return redirect()->route('page.index');
            }
            elseif (Auth::user()->power == '1') {
                return redirect()->route('admin.index');
            }
    	}
    	else {
    		return redirect()->back()->with('thongbao', 'email hoặc mật khẩu không chính xác');
    	}
    }
    // kết thúc phần đăng nhập
    public function postSignin(Request $req){
    	$this->validate($req,[
    		'name' => 'required|min:2|max:30',
    		'nick_name' =>	'required|unique:users,nick_name|min:6|max:12',
    		'email' =>	'required|unique:users,email|min:10|max:30',
    		'password' => 'required|min:6|max:20',
    		're_password' => 'required|same:password'
    	],
    	[
    		'name.required' => 'tên không được để trống',
    		'name.min' => 'vui lòng nhập tên ít nhất 2 ký tự',
    		'name.max' => 'vui lòng nhập tên tối đa 30 ký tự',

    		'nick_name.required' => 'vui lòng nhập tên hiển thị trên website',
    		'nick_name.unique' => 'tên hiển thị đã được sử dụng',
    		'nick_name.min' => 'tên hiển thị tối thiểu 6 ký tự',
    		'nick_name.max' => 'tên hiển thị tối đa 12 ký tự',

    		'email.required' => 'vui lòng nhập vào email của bạn',
    		'email.unique' => 'email đã tồn tại',
    		'email.email' => 'vui lòng nhập đúng định dạng email',
    		'email.min' => 'email tối thiểu 10 ký tự',
    		'email.max' => 'email tối đa 20 ký tự',
    		'password.required' => 'mật khẩu không được để trống',
    		'password.min' => 'mật khẩu tối thiểu 6 ký tự',
    		'password.max' => 'mật khẩu tối đa 20 ký tự',
    		're_password.required' => 'vui lòng nhập lại mật khẩu',
    		're_password.same' => 'mật khẩu không giống nhau'

    	]);
    	$user = new User;
    	$user->name = ucwords($req->name);
    	$user->nick_name = $req->nick_name;
    	$user->email = $req->email;
    	$user->password = Hash::make($req->password);
    	$user->save();
    	return redirect()->back()->with('thongbao','đăng ký tài khoản thành công!');
    }
    // kết thúc phần đăng ký
    public function postLogout(){
    	Auth::logout();
    	return redirect()->route('page.index');
    }
    public function getUser(Address $address){

    	$user = Auth::id();
    	$address = Address::where('id_user',$user)->get();
    	return view('show_view.pages.user_detail',compact('address'));
    }
    public function postUser(Request $request){
        if(Auth::check()){
            $user = User::find(Auth::id());
            $user->name = $request->name;
            $user->nick_name = $request->nick_name;
            $user->save();
            return redirect()->back()->with('thongbao','cập nhật thành công');
        }
    }
    public function sp_theoloai($slug){
        $loai_sp = ProductType::where('slug',$slug)->first();
        if($loai_sp == null){
            return view('show_view.pages.sp_theo_loai',compact('loai_sp'));
        }
        else{
            $sp_theoloai = Product::where('id_type',$loai_sp->id)->get();
            return view('show_view.pages.sp_theo_loai',compact('loai_sp','sp_theoloai'));
        }
    }
    public function detail(Request $req){
        $product = Product::where('slug',$req->slug)->first();
        // dd($product);
        if($product == null){
            return view('show_view.pages.sp_chitiet',compact('product'));
        }
        else{
            $sanpham = ProductType::find($product->id_type)->sanpham->toArray();
            $comment = Comment::Where('id_product',$product->id)->orderby('id','DESC')->paginate(4);

            if($req->ajax()){
                return view('show_view.pages.sp_chitiet',compact('product','sanpham','comment'))->render();
            }
            else{
                return view('show_view.pages.sp_chitiet',compact('product','sanpham','comment'));
            }
        }
    }
    // 
    //gio hang
    public function add_cart(Request $request, $id){
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product,$id);
        $request->Session()->put('cart',$cart);
        return redirect()->back();
    }
    public function getCheckout(){
        return view('show_view.pages.giohang_detail');
    }
    // xoa san pham trong gio hang
    public function postDelItemcart(Request $request ,$id){
            $oldCart = Session::has('cart')?Session::get('cart'):null;
            $cart = new Cart($oldCart);
            $cart->removeItem($id);
            //neu so luong bang 0 thi xoa session gio hang
            if(count($cart->items) > 0){
                Session::put('cart',$cart);// sau khi remove thi phai put lai gio hang
            }
            else{
                Session::forget('cart');
            }
            return redirect()->back();
    }
    public function checkout(Address $address){
        $user = Auth::id();
        $address = Address::where('id_user',$user)->get();
        return view('show_view.pages.check_out',['address' => $address]);
    }
}
