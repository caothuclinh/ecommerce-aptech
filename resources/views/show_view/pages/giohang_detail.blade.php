@extends('show_view.layout.master')
@section('title')
gio hang
@endsection
@section('content')
<!-- star new -->
	<div class="container">
		<div class="row">
			<div class="col-12">

				@if(Session::has('cart'))
				<h3 class="text-info"><i class="fas fa-cart-plus"></i> giỏ hàng của bạn @if(Auth::check()){{ Auth::user()->name }}@endif</h3>
				<table class="text-center table table-hover table-responsive table-inverse">
					<thead>
						<tr>
							<th>tên sản phẩm</th>
							<th>hình ảnh</th>
							<th>giá</th>
							<th>số lượng</th>
						</tr>
					</thead>
					<tbody>
						@foreach($product_cart as $product)
						<tr>
							<td class="text-info font-weight-bold">{{ $product['item']['name'] }}</td>
							<td><img style="width: 100px; height: 100px" src="soucre/image/product/{{ $product['item']['image'] }}" alt=""></td>
							<td class="text-danger font-weight-bold">@if($product['item']['promotion_price'] == 0){{ number_format($product['item']['unit_price']) }}@else{{ number_format($product['item']['promotion_price']) }}@endif VNĐ</td>
							<td>{{ $product['qty'] }}</td>
							<td>
								<form action="{{ route('cart.delete',$product['item']['id']) }}" method="post">
									@method('DELETE')
									@csrf
									<button class="btn btn-danger">xóa</button>
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="text-right mr-5 pr-5 text-danger font-weight-bold display-5">tổng tiền:{{ number_format(Session('cart')->totalPrice) }} VNĐ</div>
			</div>
		</div>
		{{-- end row --}}
		<div class="row mt-3">
			<div class="col-12">
				<div class="float-right mr-5 pr-5">
					@if(Auth::check())
					<a href="{{ route('cart.getcheckout') }}" class=" pl-3 pr-3 text-right btn btn-outline-success">tiến hành đặt hàng</a>
					@else
						<p>vui lòng <a href="{{ route('page.getLogin') }}" class="btn btn-outline-dark">đăng nhập</a> để đặt hàng</p>

					@endif
					
				</div>
			</div>
		</div>
		@else
			<p class="text-danger display-4 ">không có đơn hàng nào</p>
		@endif
	</div>		
<!-- end container -->
@endsection