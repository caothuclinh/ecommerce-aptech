@extends('show_view.layout.master')
@section('title','đăng nhập')
@section('content')
<!-- star form -->
	<div class="container">
		
		<div class="row mt-5 mb-5 pt-3 pb-3">
			@if(count($errors) > 0)
				<div class="col-8 mb-0 mt-0 m-auto">
					<div class="alert alert-danger">
						@foreach($errors->all() as $err)
						{{ $err }} <br>
						@endforeach
					</div>
				</div>
			@endif
			@if(Session::has('thongbao'))
				<div class="col-8 mb-0 mt-0 m-auto">
					<div class="alert alert-danger">
						{{Session::get('thongbao')}}
					</div>
				</div>
			@endif
			<div class="col-8 mb-0 mt-0 m-auto">
				<h3 class="text-justify text-primary text-center">đăng nhập tài khoản</h3>
				<form action="{{ route('page.postLogin') }}" method="post">
					@method('POST')
					@csrf
				  <div class="form-group">
				    <label for="inputEmail4">Email:</label>
				    <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="nhập email của bạn">
				  </div>
				    <div class="form-group ">
				    <label for="inputPassword4">Mật khẩu:</label>
				    <input type="text" name="password" class="form-control" id="inputPassword4" placeholder="nhập mật khẩu của bạn">
				  </div>
				    
				  <button type="submit" class="btn btn-danger">Login</button>
				</form>
			</div>
		</div>
	</div>
@endsection