@extends('show_view.layout.master')
@section('title')
xác nhận thông tin
@endsection
@section('content')
<!-- star new -->
	<div class="container">
		<div class="row">
			<div class="col-12">
	@if (Auth::check())
		@if(Session::has('cart'))
		<h3 class="text-info"><i class="fas fa-cart-plus"></i>{{ Auth::user()->name }}</h3>
			</div>
		</div>
		<form action="" method="">
		<div class="row">
			<div class="col-12 col-md-6">
				  <div class="form-row">
				    <div class="form-group col-md-6">
				      <label for="inputEmail4">Email</label>
				      <input type="email" name="email" disabled="" class="form-control" id="inputEmail4" placeholder="Email" value="{{ Auth::user()->email }}">
				    </div>
				    <div class="form-group col-md-6">
				      <label for="inputEmail4">tên:</label>
				      <input type="email" name="name" disabled="" class="form-control" id="inputEmail4" placeholder="Email" value="{{ Auth::user()->name }}">
				    </div>
				    
				  </div>
				  <div class="form-group">
					    <label for="inputAddress">địa chỉ mặc định: </label>
					    @foreach($address as $add)
						    @if($add->default != null)
						    <p>
						    	{{ $add->city }} - {{ $add->district }} - {{ $add->ward }}
						    </p>
						    <p> - sdt: {{ $add->phone_number }}</p>
						    @endif
					    @endforeach
					    <a href="{{ route('address.index') }}" class="btn btn-outline-info"><i class="far fa-edit"></i></a>
				  </div>
				  <div class="form-group" id="pay">
				    	hình thức thanh toán:
					    <label for="payment">
					    	<select class="form-control" name="pay" id="">
					    		<option value="COD">thanh toán khi nhận hàng</option>
					    		<option value="ATM">chuyển khoản</option>
					    	</select>
					    </label>
				  </div>
				  <div class="form-group">
				  	<label for="">lời nhắn:</label>
				  	<textarea class="form-control" name="note" placeholder="không bắt buộc"></textarea>
				  </div>
				
			</div>
			{{-- end col --}}
			<div class="col-12 col-md-6">
				<table class="text-center table table-hover table-inverse">
					<thead>
						<tr>
							<th colspan="3">thông tin đơn hàng</th>
						</tr>
					</thead>
					<tbody>
					@foreach($product_cart as $product)

						<tr>
							<td><a href="{{ route('product.detail',$product['item']['slug']) }}">
								<img style="width: 50px!important; height: 50px!important" src="soucre/image/product/{{ $product['item']['image'] }}" alt="">
							</a></td>
							<td>@if($product['item']['promotion_price'] == 0){{ number_format($product['item']['unit_price']) }} VNĐ@else{{ number_format($product['item']['promotion_price']) }} VNĐ@endif</td>
							<td>Số Lượng: {{ $product['qty'] }}</td>
						</tr>
					@endforeach
						<tr>
							<td colspan="2" class="text-danger"> tổng: {{ number_format(Session('cart')->totalPrice) }} VNĐ</td>
							<td><button class="btn btn-outline-success" type="submit">đặt hàng</button>	</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		{{-- end row --}}
		</form>		
		</div>
		@endif
	@else
		<p class="text-danger display-4 ">vui lòng nhấn vào <a href="{{ route('page.getLogin') }}">đây</a> để đăng nhập lại</p>
	@endif
	</div>		
<!-- end container -->
@endsection