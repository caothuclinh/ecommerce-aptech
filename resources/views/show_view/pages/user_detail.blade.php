@extends('show_view.layout.master')
@if(Auth::check())
@section('title','chi tiết urser')
@else
@section('title','không tồn tại')
@endif
@section('content')
<!-- star form -->
	<div class="container mt-5 pt-3">
		<div class="row">
		@if(Auth::check())
			<div class="col-4 col-md-4">
				<nav class="navbar navbar-light bg-faded">
					<ul class="menu-user nav navbar-nav">
						@if(Auth::user()->power == '1')
						<li class="nav-item ">
							<a href="{{ route('admin.index') }}" class=" nav-link text-primary font-weight-bold">quản lý database <i class="fas fa-angle-right"></i></a>
						</li>
						@endif
						<li class="nav-item ">
							<a href="{{ route('address.index') }}" class=" nav-link text-primary font-weight-bold">địa chỉ <i class="fas fa-angle-right"></i></a>
						</li>
						<li class="nav-item btn btn-group text-primary font-weight-bold">
							<span>avatar <i class="fas fa-angle-right"></i></span>
						</li>
						<li class="nav-item btn btn-group text-primary font-weight-bold">
							<span>thay đổi mật khẩu <i class="fas fa-angle-right"></i></span>
						</li>
						<li class="nav-item btn btn-group text-primary font-weight-bold">
							<span>đơn hàng <i class="fas fa-angle-right"></i></span>
						</li> 
					</ul>
				</nav>
			</div>

			<div class="col-8 col-md-8 bg-light">
				<p class="font-weight-bold">Hồ Sơ Của Tôi</p>
				<p class="text-dark">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
				<p class="text-dark">email: <span class="text-primary">{{ Auth::user()->email }}</span></p>
				<div id="content">
					<form action="{{ route('page.postUser') }}" method="post">
						@method('PATCH')
						@csrf
						<div class="row">
							<div class="form-group col-6">
								<span>tên: </span><input name="name" type="text" value="{{ Auth::user()->name }}" class="form-control">
							</div>
							<div class="form-group col-6">
								<span>Tên hiển thị: </span><input name="nick_name" type="text" value="{{ Auth::user()->nick_name }}" class="form-control">
							</div>
						</div>
						@foreach($address as $add)
						@if ($add->default != null)
							<div class="row">
								<div class="form-group col-6">
									<span>số điện thoại: </span><input type="text" disabled=""  value="{{ $add->phone_number }}"  class="form-control">
								</div>
								<div class="form-group col-6">
									<span class="d-block">địa chỉ mặc định: </span><span class="text-primary">{{$add->city }} | {{ $add->district }} | {{ $add->ward }} | {{ $add->home }} </span>
								</div>
							</div>
						@endif
						@endforeach
						<button type="submit" class ="btn btn-danger">lưu thay đổi</button>
					</form>
				</div>
			</div>
		</div>
		@else
			<div class="col-12"><p class="display-4 text-warning font-weight-bold">không tồn tại trang này</p></div>
			<div class="col-12"><a href="{{ route('page.index') }}" class="btn btn-danger">trở về trang chủ</a></div>
		@endif
	</div>
@endsection