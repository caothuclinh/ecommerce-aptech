@extends('admin.layout.master')
@section('title','thêm mới sản phẩm')
@section('content')
<div class="wrapper bg-light">
@component('admin.layout.components')
	thêm mới sản phẩm
@endcomponent

<div class="container-fluid">
	@if (Session::has('mesage'))
		{{-- expr --}}
			<div class="row">
				<div class="col-12 ">
					<div class="alert alert-{{ Session::get('flag') }}">{{ Session::get('mesage') }}</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
				<a class="btn btn-light" href="{{ route('product.index') }}">trở về trang danh sách</a>
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
	<form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
		@method('POST')
		@csrf
		<div class="row">
			<fieldset class="form-group col-12 col-md-6">
			<label for="exampleInputName1">tên sản phẩm:</label>
			<input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="tên sản phẩm">
		</fieldset>
		<fieldset class="form-group col-12 col-md-6">
			<label for="exampleInputName1">loại sản phẩm:</label>
			<select name='productType' class="form-control" id="eexampleSelect11">
				@foreach($loai_sp as $key => $value)
				<option value="{{ $value }}">{{ $key }}</option>
				@endforeach
			</select>
		</fieldset>
		</div>
		<div class="row">
			<fieldset class="form-group col-12 col-md-4">
				<label for="exampleInputName1">giá sản phẩm:</label>
				<input type="number" name="price" class="form-control">
			</fieldset>
			<fieldset class="form-group col-12 col-md-4">
				<label for="promotion">khuyến mãi:</label>
				<select name="promotion" id="" class="form-control">
					<option value="0">0</option>
					<option value="90">10%</option>
					<option value="75">25%</option>
					<option value="50">50%</option>
				</select>
			</fieldset>
			<fieldset class="form-group col-12 col-md-4">
				<label for="exampleInputName1">tình trạng sản phẩm:</label>
				<select name="new" id="" class="form-control">
					<option value="1">mới</option>
					<option value="0">cũ</option>
				</select>
			</fieldset>
			
		</div>
		<fieldset class="form-group">
			<label for="exampleInputName1">description:</label>
			<textarea type="text" name="description" class="form-control" id="exampleInputName1" placeholder="mô tả chi tiết sản phẩm"></textarea>
		</fieldset>
		<fieldset class="form-group">
			<label for="exampleInputName1">nội dung sản phẩm:</label>
			<textarea type="text" name="content" id="editor" class="form-control" id="exampleInputName1" placeholder="nội dung chi tiết sản phẩm"></textarea>
			<script>
				ClassicEditor
		            .create( document.querySelector( '#editor' ) )
		            .catch( error => {
		                console.error( error );
		            } );
		    </script>
		</fieldset>
		
		<fieldset class="form-group">
			<label for="exampleInputName1">hình ảnh:</label>
			<input type="file" name="image" class="form-control" id="exampleInputName1" placeholder="hình ảnh sản phẩm">
		</fieldset>
		
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
@endsection
