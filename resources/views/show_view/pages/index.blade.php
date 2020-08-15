@extends('show_view.layout.master')
@section('title','trang chu')
@section('content')
<!-- star new -->
@include('show_view/layout/slide')
		<div class="container">
			<div class="row pt-3 mb-3 position-relative title-product">
				<div class=" col-12">
					<h3 class="text-primary font-weight-bold">sản phẩm mới <i class="fas fa-chevron-circle-right"></i></h3>
				</div>
			</div>
			<div class="row">
				@foreach($sp_moi as $sp)
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
		</div>
		<!-- end container -->
		<!-- end product new -->
		<!-- star promotion -->
		<div class="container">
			<div class="row pt-3 mb-3 position-relative title-product">
				<div class=" col-12 col-md-6">
					<h3 class="text-primary font-weight-bold">sản phẩm khuyến mại <i class="fas fa-chevron-circle-right"></i></h3>
				</div>
			</div>
			<div class="row">
				@foreach($sp_khuyenmai as $khuyenmai)
				<div class="col-12 col-md-6 col-lg-4 mb-5">
					<div class="product">
						<div class="img" style="background-image: url('soucre/image/product/{{ $khuyenmai->image }}');"></div>
						<div class="description bg-danger">
							<a href="{{ route('product.detail',$khuyenmai->slug) }}" class=" ml-2 text-left text-wrap d-block">
								<p class="price  font-weight-bold"> 
									<span class="text-warning unit_price">{{ number_format($khuyenmai->unit_price) }} VNĐ</span>
									<span class="text-primary promotion_price"> {{ number_format($khuyenmai->promotion_price) }} VNĐ</span>
								</p>
								
								<p class="title text-success font-weight-bold">{{ $khuyenmai->name }}</p>
								<div class="thong-tin text-wrap">
										<p class="text-wrap">{{ $khuyenmai->description }}</p>
								</div>
							</a>
						</div>
						<!-- end description -->
						<a href="{{ route('product.cart',$khuyenmai->id) }}" class=" cart position-absolute btn  btn-block btn-outline-primary text-white">add to cart <i class="fas fa-cart-plus"></i></a>
					</div>
				</div>
				@endforeach
				{{-- end col --}}
				
			</div>
			<!-- end row	 -->
		</div>
		<!-- end container -->
		<!-- end product promotion -->
		<!-- star sản phẩm khác -->
		<div class="container">
			<div class="row pt-3 mb-3 position-relative title-product">
				<div class=" col-12 col-md-6">
					<h3 class="text-primary font-weight-bold">sản phẩm khác <i class="fas fa-chevron-circle-right"></i></h3>
				</div>
			</div>
			<div class="row">
				<!--san pham khac -->
				@foreach($sp_khac as $khac)
				<div class="col-12 col-md-6 col-lg-4 mb-5">
					<div class="product">
						<div class="img" style="background-image: url(soucre/image/product/{{ $khac->image }});"></div>
						<div class="description bg-danger">
							<a href="{{ route('product.detail',$khac->slug) }}" class=" ml-2 text-left text-wrap d-block">
								<p class="price  font-weight-bold">
								@if($khac->promotion_price !=0)
									<span class="text-warning unit_price">{{ number_format($khac->unit_price) }} VNĐ</span> <span class="text-primary promotion_price"> {{ number_format($khac->promotion_price) }} VNĐ</span></p>
									@else
									<span class="text-warning">{{ number_format($khac->unit_price) }} VNĐ</span>
								@endif
								<p class="title text-success font-weight-bold">{{ $khac->name }}</p>

								<div class="thong-tin text-wrap">
									<p class=" text-wrap font-weight-bold">{{ $khac->description }}</p>
								</div>
							</a>
						</div>
						<!-- end description -->
						<a href="{{ route('product.cart',$khac->id) }}" class=" cart position-absolute btn  btn-block btn-outline-primary text-white">add to cart <i class="fas fa-cart-plus"></i></a>
					</div>
				</div>
				{{-- end col --}}
				@endforeach
			</div>
			<!-- end row	 -->
		</div>
		<!-- end container -->
		<!-- end sản phẩm khác -->
@endsection