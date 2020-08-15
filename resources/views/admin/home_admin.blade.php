@extends('admin.layout.master')
@section('title','home admin')
@section('content')
<div class="wrapper bg-light">
@component('admin/component/title')
trang xử lý back end database 
@endcomponent

	<div class="container">
		<div class="row">
			@if(count($errors) > 0)
			<div class="col-12 alert-warning alert">
				@foreach($errors->all() as $err)
				{{ $err }} <br>
				@endforeach
			</div>
			@endif
			@if(Session::has('thongbao'))
			<div class="col-12 alert alert-success">
				{{ Session::get('thongbao') }}
			</div>
			@endif
			<div class="col-12">
				<form action="{{ route('admin.login') }}" method="post">
					@method('POST')
					@csrf
				  <div class="form-group">
				    <label for="exampleInputEmail1">Email address</label>
				    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
				    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Password</label>
				    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
				  </div>
				  <button type="submit" class="btn btn-outline-info">Login</button>
				</form>
			</div>
		</div>
	</div>
 </div>
 @endsection