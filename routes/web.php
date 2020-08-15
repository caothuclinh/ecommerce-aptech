<?php
use App\Product;
use Illuminate\Support\Str;
use App\Address;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin'],function(){
	Route::get('trang-chu','AdminController@index')->name('admin.index');
	Route::post('trang-chu',[
		'as' => 'admin.login',
		'uses' => 'UserController@postLogin'
	]);
	Route::get('loai-san-pham',[
		'as' => 'productType.index',
		'uses' => 'ProductTypeController@index'
	]);
	Route::get('them-moi-loai-sp',[
		'as' => 'productType.create',
		'uses' => 'ProductTypeController@create'
	]);
	Route::PATCH('them-moi-loai-sp',[
		'as' => 'productType.store',
		'uses' => 'ProductTypeController@store'
	]);
	Route::get('sua-loai-sp/{productType}',[
		'as' => 'productType.edit',
		'uses' => 'ProductTypeController@edit'
	]);
	Route::PATCH('sua-loai-sp/{productType}',[
		'as' => 'productType.update',
		'uses' => 'ProductTypeController@update'
	]);
	Route::DELETE('loai-san-pham/{productType}',[
		'as' => 'productType.delete',
		'uses' => 'ProductTypeController@destroy'
	]);
	Route::resource('product','ProductController');
	Route::POST('minus/{product}',[
		'as' => 'product.minus',
		'uses' => 'ProductController@minus'
	]);
	Route::POST('plush/{product}',[
		'as' => 'product.plush',
		'uses' => 'ProductController@plush'
	]);
	Route::get('add-to-cart/{id}',[
		'as' => 'product.cart',
		'uses' => 'PageController@add_cart'
	]);
	
});
Route::group(['prefix' => 'front_end'],function(){
	Route::get('trang-chu','PageController@index')->name('page.index');

	Route::get('dang-ky','PageController@getSignin')->name('page.getSignin');
	Route::POST('dang-ky','PageController@postSignin')->name('page.postSignin');

	Route::get('dang-nhap','PageController@getLogin')->name('page.getLogin');
	Route::POST('dang-nhap','PageController@postLogin')->name('page.postLogin');
	Route::POST('dang-xuat','PageController@postLogout')->name('page.logout');
	Route::get('user-detail','PageController@getUser')->name('page.getUser');
	Route::PATCH('user-detail','PageController@postUser')->name('page.postUser');

	Route::get('dia-chi','AddressController@index')->name('address.index');
	Route::get('them-dia-chi','AddressController@create')->name('address.create');
	Route::PATCH('them-dia-chi','AddressController@store')->name('address.store');
	Route::get('sua-dia-chi/{address}','AddressController@edit')->name('address.edit');
	Route::PATCH('sua-dia-chi/{address}','AddressController@update')->name('address.update');
	Route::DELETE('xoa-dia-chi/{address}','AddressController@destroy')->name('address.delete');
	Route::PATCH('dia-chi/{address}','AddressController@default')->name('address.default');
	//address
	Route::get('district/{id}','AddressController@district');
	Route::get('ward/{id}','AddressController@ward');
	Route::group(['prefix' => 'san-pham'], function() {
	    //
	    Route::get('product/{productType}',[
	    	'as' => 'product.sp_theoloai',
	    	'uses' => 'PageController@sp_theoloai'
	    ]);
	    Route::get('chi-tiet/{slug}',[
	    	'as' => 'product.detail',
	    	'uses' => 'PageController@detail'
	    ]);
	    Route::POST('chi-tiet/{slug}',[
	    	'as' => 'comment.store',
	    	'uses' => 'CommentController@store'
	    ]);
	});
	Route::get('gio-hang-chi-tiet',[
		'as' => 'cart.detail',
		'uses' => 'PageController@getCheckout'
	]);
	Route::DELETE('xoa-gio-hang/{id}',[
		'as' => 'cart.delete',
		'uses' => 'PageController@postDelItemcart'
	]);
	Route::get('xac-nhan-gio-hang','PageController@checkout')->name('cart.getcheckout');
	Route::get('dia-chi-mac-dinh',function(){
		$address = Address::where('id_user', Auth::id())->get();
		
			foreach ($address as $add) {
				if($add->default != null){
				$diachi = $add->city . " - " . $add->district . " - " . $add->ward . " - " . $add->home . " - " . $add->phone_number;
				}
			}
				echo $diachi;
		// echo $address->home;
	});
});
