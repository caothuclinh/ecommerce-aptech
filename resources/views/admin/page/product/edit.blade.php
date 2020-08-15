@extends('admin.layout.master')
@section('title','sửa loại sản phẩm')
@section('content')
<div class="wrapper bg-light">
@component('admin.layout.components')
	sửa sản phẩm<br>
@endcomponent
	{{-- expr --}}
	<div class="container-fluid">
		<p class="text-info">{{ $data->name }}</p>
	@if(count($errors)>0)
	<div class="row">
		<div class="col">
			<div class="alert alert-danger">
				@foreach($errors->all() as $err)
				{{ $err }} <br>
				@endforeach
			</div>
		</div>
	</div>
	@endif
@if (Session::has('mesage'))
	<div class="row">
		<div class="col-12 ">
			<div class="alert alert-{{ Session::get('flag') }}">{{ Session::get('mesage') }}</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
		<a class="btn btn-light" href="{{ route('product.index') }}">trở về trang danh sách</a></div>
	</div>
@endif
	
	<form action="{{ route('product.update',$data->id) }}" method="post" enctype="multipart/form-data">
		@method('PATCH')
		@csrf
		<div class="row">
			<fieldset class="form-group col-12 col-md-6">
			<label for="exampleInputName1">tên sản phẩm:</label>
			<input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="{{ $data->name }}">
		</fieldset>
		<fieldset class="form-group col-12 col-md-6">
			<label for="exampleInputName1">loại sản phẩm<span class="text-danger">*</span>:</label>
			<select name='productType' class="form-control" id="eexampleSelect11">
				@foreach($loai_sp as $key)
				<option value="{{ $key->id }}">{{ $key->name }}</option>
				@endforeach
			</select>
		</fieldset>
		</div>
		<div class="row">
			<fieldset class="form-group col-12 col-md-4">
				<label for="exampleInputName1">giá sản phẩm<span class="text-danger">*</span>:</label>
				<input type="number" name="price" class="form-control" placeholder="{{ $data->unit_price }}" value="{{ $data->unit_price }}">
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
				<label for="exampleInputName1">tình trạng sản phẩm<span class="text-danger">*</span>:</label>
				<select name="new" id="" class="form-control">
					<option value="1">mới</option>
					<option value="0">cũ</option>
				</select>
			</fieldset>
			
		</div>
		<fieldset class="form-group">
			<label for="exampleInputName1">description<span class="text-danger">*</span>:</label>
			<textarea type="text" name="description" class="form-control" id="exampleInputName1" placeholder="">{{ $data->description }}</textarea>
		</fieldset>
		<fieldset class="form-group">
			<label for="exampleInputName1">hình ảnh:</label>
			<input type="file" name="image" class="form-control" id="exampleInputName1" placeholder="hình ảnh sản phẩm">
		</fieldset>
		<fieldset class="form-group">
			<label for="exampleInputName1">nội dung sản phẩm<span class="text-danger">*</span>:</label>
			<textarea type="text" name="content" id="editor" class="form-control" id="exampleInputName1" placeholder="">{{ $data->content }}</textarea>
			<script>
				ClassicEditor
		            .create( document.querySelector( '#editor' ) )
		            .catch( error => {
		                console.error( error );
		            } );
		    </script>
		</fieldset>
		
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
@endsection
