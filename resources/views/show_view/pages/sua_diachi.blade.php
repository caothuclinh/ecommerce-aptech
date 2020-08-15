@extends('show_view.layout.master')
@if(Auth::check())
@section('title','chi tiết urser')
@else
@section('title','không tồn tại')
@endif
@section('content')
<!-- star form -->

	<div class="container mt-5 pt-3">
		@if(Session::has('thongbao'))
			<div class="row">
				<div class="col">
					<p class="text-center text-success display-4">{{ Session::get('thongbao') }}</p>
				</div>
			</div>
		@endif
		<div class="row">
		@if(Auth::check())
			<div class="col-8 col-md-8 bg-light m-auto">
				<h3 class="text-justify text-primary text-center">sửa địa chỉ</h3>
				<p class="text-primary">{{ $add->city }} | {{ $add->district }} | {{ $add->ward }} | {{ $add->home }} | SDT: {{ $add->phone_number }}</p>
					<a href="{{ route('address.index') }}" class="btn btn-outline-secondary">xem tất cả địa chỉ của bạn</a>
				<div id="content" class="mt-3">
					<form action="{{ route('address.update', $add->id) }}" method="post">
							@method('PATCH')
							@csrf
							<div class="row">
							<fieldset class=" d-inline-block form-group col-12 col-md-6 col-lg-4">
								<label for="exampleSelect1">Thành Phố:</label>
								<select name="city" class="form-control" id="eexampleSelect11">
									<option value="">--chọn thành phố--</option>
									@foreach($cities as $key =>$value)
									<option value="{{ $value }}">{{ $key }}</option>
									@endforeach
								</select>

							</fieldset>
							<fieldset class="d-inline-block form-group col-12 col-md-6 col-lg-4">
								<label for="exampleSelect1">Quận Huyện:</label>
								<select name="district" class="form-control" id="eexampleSelect11">
									<option value="">--Chưa chọn tỉnh thành--</option>
								</select>

							</fieldset>
							<fieldset class="d-inline-block form-group col-12 col-md-6 col-lg-4">
								<label for="exampleSelect1">Phường xã:</label>
								<select name="ward" class="form-control" id="eexampleSelect11">
									<option value="">--chưa chọn quận huyện--</option>
								</select>

							</fieldset>

							<fieldset class="d-inline-block form-group col-12 col-md-6">
								<label for="phone">Số điện thoại:</label>
								<input id="phone" name="phone" class="form-control" type="text" placeholder="nhập số điện thoại của bạn">

							</fieldset>
							<fieldset class="d-inline-block form-group col-12 col-md-6">
								<label for="home">Số nhà, Tên đường:</label>
								<input id="home" name="home" class="form-control" type="text" placeholder="Số nhà Tên đường">

							</fieldset>
							<div class="form-group col-12">
								<button class="btn btn-outline-danger">Lưu thay đổi</button>
							</div>
						</div>
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