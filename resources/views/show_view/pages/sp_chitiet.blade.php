@extends('show_view.layout.master')
@section('title')
@if($product == null)
không tìm thấy sản phẩm này
@else
sản phẩm {{ $product->name }}
@endif
@endsection
@section('content')
<!-- star new -->
		<div class="container">
			@if($product == null)
				<div class="row pt-3 mb-3 position-relative title-product">
					<div class="row">
						<div class="col">
							<p class="text-secondary pl-3 display-5 font-weight-bold">không tìm thấy sản phẩm này</p>
						</div>
					</div>
				</div>
			@else
			<!-- end row	 -->
			
			<div class="row pt-3 overflow-hidden">
				<div class="col-12">
					<p class="name_product text-danger">{{ $product->name }}</p>
				</div>
				<div class="col-12 col-md-6">
					<img class="w-100" src="soucre/image/product/{{ $product->image }}" alt="">
				</div>
				<div class="col-12 col-md-6">
					<div class="row">
						<div class="col">
							<p class="price display-5  font-weight-bold"> @if($product->promotion_price != 0)
							<span class="text-warning unit_price">{{ number_format($product->unit_price) }} VNĐ</span>
							<span class="text-primary promotion_price"> {{ number_format($product->promotion_price) }} VNĐ</span>
							@else
							<span class="text-warning">{{ number_format($product->unit_price) }} VNĐ</span>
							@endif</p>
							<div class="description">
								<p class="text-justify text-info">
									{{ $product->description }}
								</p>
							</div>
							<div class="add_to_card">
								<a href="{{ route('product.cart',$product->id) }}" class="btn btn-outline-danger">thêm vào giỏ hàng</a>
							</div>
						</div>
					</div>
					{{-- end row --}}
					<div class="row mt-3 overflow-auto">
						<div class="comment col">
							@if(count($comment)<=0)
								<span class="text-info font-weight-bold"> chưa có bình luận nào</span>
							@endif
							@foreach($comment as $cmt)
							<span class="text-danger font-weight-bold">{{ $cmt->name_user }}</span>
							<p class="text-secondary">{{ $cmt->content }} <span class="text-right"><a><i class="fas fa-edit"></i></a></span></p>
							<hr>
							@endforeach
							@if(Auth::check())
							<form action="{{ route('comment.store',$product->slug) }}" method="POST">
								@method('POST')
								@csrf
								<fieldset>
								<input type="text" class="form-control" name="content" placeholder="bình luận sản phẩm">
								<button type="submit" class="mt-2 pl-5 pr-5 btn btn-primary">Gửi</button>
								</fieldset>
							</form>
							@else
								<p class="text-dark"> vui lòng đăng nhập để bình luận</p>
							@endif
						</div>

					</div>
					<div class="row mt-3">
						{!! $comment->links() !!}
					</div>
					<div>
						<script>
							function GetURLParameter(sParam) {
							    var sPageURL = window.location.search.substring(1);
							    var sURLVariables = sPageURL.split('&');
							    for (var i = 0; i < sURLVariables.length; i++) {
							        var sParameterName = sURLVariables[i].split('=');
							        if (sParameterName[0] == sParam) {
							            return sParameterName[1];
							        }
							    }
							}
							var tech = GetURLParameter('front_end');
							console.log(tech);
						</script>
					</div>
					{{-- end test --}}
				</div>
			</div>
		{{-- san pham khac --}}
			<div class="row pt-3 mb-3 position-relative title-product">
				<div class=" col-12 col-md-6">
					<h3 class="text-primary font-weight-bold">sản phẩm tương tự <i class="fas fa-chevron-circle-right"></i></h3>
				</div>
			</div>
			<div class="row">
				@foreach($sanpham as $sp)
				<div class="col-12 col-md-6 col-lg-4 mb-5">
					<div class="product">
						<div class="img" style="background-image: url('soucre/image/product/{{ $sp['image'] }}');"></div>
						<div class="description bg-danger">
							<a href="{{ route('product.detail',$sp['slug']) }}" class=" ml-2 text-left text-wrap d-block">
								<p class="price  font-weight-bold"> @if($sp['promotion_price'] != 0)
									<span class="text-warning unit_price">{{ number_format($sp['unit_price']) }} VNĐ</span>
									<span class="text-primary promotion_price"> {{ number_format($sp['promotion_price']) }} VNĐ</span>
									@else
									<span class="text-warning">{{ number_format($sp['unit_price']) }} VNĐ</span>
								@endif</p>
								
								<p class="title text-success font-weight-bold">{{ $sp['name'] }}</p>

								<div class="thong-tin text-wrap">
										<p class="text-wrap">{{ $sp['description'] }}</p>
								</div>
							</a>
						</div>
						<!-- end description -->
						<a href="" class=" cart position-absolute btn  btn-block btn-outline-primary text-white">add to cart <i class="fas fa-cart-plus"></i></a>
					</div>
				</div>
				@endforeach
				<!-- end col -->
			</div>
			<div class="row pt-3 content">
				<div class="col-8 mt-0 mr-0 ml-auto mr-auto">
					{!! $product->content !!}
				</div>
			</div>

		</div>
		<!-- end product -->
		@endif
		<!-- end container -->
@endsection