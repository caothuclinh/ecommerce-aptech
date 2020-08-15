@extends('show_view.layout.master')
@section('title','đăng ký')
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
					<div class="alert alert-success">
						{{ Session::get('thongbao') }}
					</div>
					<a href="{{ route('page.getLogin') }}" class="btn btn-info">đăng nhập ngay</a>
				</div>
		@endif
			<div class="col-8 mb-0 mt-0 m-auto">
				<h3 class="text-justify text-primary text-center">đăng ký tài khoản</h3>
				<form action="{{ route('page.postSignin') }}" method="post">
					@method('POST')
					@csrf
				  <div class="form-row">
				    <div class="form-group col-md-6">
				      <label for="inputName4">tên:</label>
				      <input type="text" name="name" class="form-control" id="inputName4" placeholder="họ tên của bạn	">
				    </div>
				    <div class="form-group col-md-6">
				      <label for="inputUser4">tên hiển thị:</label>
				      <input type="text" name="nick_name" class="form-control" id="inputUser4" placeholder="tên hiển thị">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputEmail4">Email:</label>
				    <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="nhập email của bạn">
				  </div>
				   <div class="form-row">
				    <div class="form-group col-md-6">
				    <label for="inputPassword4">Mật khẩu:</label>
				    <input type="text" name="password" class="form-control" id="inputPassword4" placeholder="nhập mật khẩu của bạn">
				  </div>
				    <div class="form-group col-md-6">
				      <label for="inputRePassword">Nhập lại mật khẩu:</label>
				      <input type="text" name="re_password" class="form-control" id="inputRePassword" placeholder="nhập lại mật khẩu của bạn">
				    </div>
				  </div>
				  <button type="submit" class="btn btn-danger">Sign in</button>
				</form>
			</div>
		</div>
	</div>
@endsection