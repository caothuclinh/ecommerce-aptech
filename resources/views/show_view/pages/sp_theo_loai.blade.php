@extends('show_view.layout.master')
@section('title')
@if($loai_sp == null)
không tìm thấy sản phẩm này
@else
san pham: {{ $loai_sp->name }}
@endif
@endsection
@section('content')
<!-- star new -->
		<div class="container">
			@if($loai_sp == null)
				<div class="row pt-3 mb-3 position-relative title-product">
					<div class="row">
						<div class="col">
							<p class="text-secondary pl-3 display-5 font-weight-bold">không tìm thấy sản phẩm này</p>
						</div>
					</div>
				</div>
			@else
			<div class="row pt-3 mb-3 position-relative title-product">
				<div class=" col-12 col-md-6">
					<h3 class="text-primary font-weight-bold">{{ $loai_sp->name }} <i class="fas fa-chevron-circle-right"></i></h3>
				</div>
				<div class="row">
					<div class="col">
						<p class="text-secondary display-5 font-weight-bold"> có {{ count($sp_theoloai) }} sản phẩm</p>
					</div>
				</div>
			</div>

			<div class="row">
				@foreach($sp_theoloai as $sp)
				<div class="col-12 col-md-6 col-lg-4 mb-5">
					<div class="product">
						<div class="img" style="background-image: url('soucre/image/product/{{ $sp->image }}');"></div>
						<div class="description bg-danger">
							<a href="{{ route('product.detail',$sp->slug) }}" class=" ml-2 text-left text-wrap d-block">
								<p class="price  font-weight-bold"> @if($sp->promotion_price != 0)
									<span class="text-warning unit_price">{{ number_format($sp->unit_price) }} VNĐ</span>
									<span class="text-primary promotion_price"> {{ number_format($sp->promotion_price) }} VNĐ</span>
									@else
									<span class="text-warning">{{ number_format($sp->unit_price) }} VNĐ</span>
								@endif</p>
								
								<p class="title text-success font-weight-bold">{{ $sp->name }}</p>

								<div class="thong-tin text-wrap">
										<p class="text-wrap">{{ $sp->description }}</p>
								</div>
							</a>
						</div>
						<!-- end description -->
						<a href="{{ route('product.cart',$sp->id) }}" class=" cart position-absolute btn  btn-block btn-outline-primary text-white">add to cart <i class="fas fa-cart-plus"></i></a>
					</div>
				</div>
				@endforeach
				<!-- end col -->
			</div>
			<!-- end row	 -->
			@endif
		</div>
		<!-- end container -->
		<!-- end product -->
		
		<!-- end container -->
@endsection