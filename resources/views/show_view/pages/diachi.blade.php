@extends('show_view.layout.master')

@section('title')
địa chỉ: {{ Auth::user()->name }}
@endsection
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
						{{Session::get('thongbao')}}
					</div>
				</div>
			@endif
			{{-- code --}}
			<div class="col-12 mb-0 mt-0 m-auto">
				<h3 class="text-justify text-primary text-center">Địa chỉ của bạn</h3>
				@if(Auth::check())
				<div class="row mb-3">
					<div class="col-6 float-left"><p class="text-primary font-weight-bold">bạn có: {{ count($datas) }} địa chỉ</p></div>
					<div class="col-6 float-right"><a href="{{ route('address.create') }}" id="create" class="float-right btn btn-outline-info">thêm mới</a></div>
				</div>
				<div class="row">
					<div class="col-12">
						<table class="table table-hover table-inverse">
							<tbody class="  font-weight-bold">
							@foreach($datas as $data)
							@if($data->default == 1)
							<tr class="text-danger">
									<td>{{ $data->city }}</td>
									<td>{{ $data->district }}</td>
									<td>{{ $data->ward }}</td>
									<td>{{ $data->home }}</td>
									<td>{{ $data->phone_number }}</td>
									<td><a href="{{ route('address.edit',$data->id) }}" class="btn btn-outline-secondary"> Sửa <i class="fas fa-edit"></i></a></td>
								</tr>
							@else
								<tr class="text-info">
									<td>{{ $data->city }}</td>
									<td>{{ $data->district }}</td>
									<td>{{ $data->ward }}</td>
									<td>{{ $data->home }}</td>
									<td>{{ $data->phone_number }}</td>
									<td><a href="{{ route('address.edit',$data->id) }}" class="btn btn-outline-secondary"> Sửa <i class="fas fa-edit"></i></a></td>
									<td>
										<form action="{{ route('address.delete',$data->id) }}" method="post">
											@method('DELETE')
											@csrf
											<button type="submit" class="btn btn-outline-danger">xóa <i class="fas fa-times"></i></button>
										</form>
									</td>
									<td><form action="{{ route('address.default',$data->id) }}" method="post">
										@method('PATCH')
										@csrf
										<button class="btn btn-outline-info">đặt làm mặc định</button>
									</form></td>
								</tr>
								@endif
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">{{ $datas->links() }}</div>
						
				@else
					<div class="col-12"><p class="display-4 text-warning font-weight-bold">không tồn tại trang này</p></div>
					<div class="col-12"><a href="{{ route('page.index') }}" class="btn btn-danger">trở về trang chủ</a></div>
				
				@endif
			</div>
		</div>
		{{-- end row --}}
			
	</div>
	{{-- end container --}}
@endsection