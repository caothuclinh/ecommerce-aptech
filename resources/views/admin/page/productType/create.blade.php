@extends('admin.layout.master')
@section('title','thêm mới loại sản phẩm')
@section('content')
<div class="wrapper bg-light">
@component('admin.layout.components')
	thêm mới loại sản phẩm
@endcomponent

<div class="container-fluid">
	@if (Session::has('thongbao'))
		{{-- expr --}}
			<div class="row">
				<div class="col-12 ">
					<div class="alert alert-success">{{ Session::get('thongbao') }}</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
				<a class="btn btn-light" href="{{ route('productType.index') }}">trở về trang danh sách</a></div>
				</div>
		</div>
	@endif
	@if(count($errors) > 0)
		<div class="row">
			<div class="col-12 alert alert-danger">
				@foreach($errors->all() as $err)
				{{ $err }} <br>
				@endforeach
			</div>
		</div>
	@endif
	<form action="{{ route('productType.store') }}" method="post" enctype="multipart/form-data">
		@method('PATCH')
		@csrf
		<fieldset class="form-group">
			<label for="exampleInputName1">name:</label>
			<input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="tên loại sản phẩm">
		</fieldset>
		<fieldset class="form-group">
			<label for="exampleInputName1">description:</label>
			<input type="text" name="description" class="form-control" id="exampleInputName1" placeholder="tên loại sản phẩm">
		</fieldset>
		<fieldset class="form-group">
			<label for="exampleInputName1">image:</label>
			<input type="file" name="image" class="form-control" id="exampleInputName1" placeholder="tên loại sản phẩm">
		</fieldset>
		
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
@endsection
