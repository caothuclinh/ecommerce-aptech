@extends('admin.layout.master')
@section('title','loại sản phẩm')
@section('content')
<div class="wrapper bg-light">
@component('admin.layout.components')
	danh sách loại sản phẩm
@endcomponent
@if (Session::has('thongbao'))
	{{-- expr --}}
	<div class="containern">
		<div class="row">
			<div class="col-8 alert alert-success">{{ Session::get('thongbao') }}</div>
		</div>
	</div>
@endif
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php $i =0;?>
				<table class="table table-hover table-bordered table-inverse">
					<thead>
						<tr>
							<th>STT</th>
							<th>id</th>
							<th>name <i class="fas fa-file-signature"></i></th>
							<th>description</th>
							<th>image</th>
							<th colspan="2" class="text-center">query</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0;?>
						@foreach($loai_sp as $sp)
						<?php $i++;?>
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $sp->id }}</td>
							<td>{{ $sp->name }}</td>
							<td class="text-left">{{ $sp->description }}</td>
							<td><img height="50" width="50" src="soucre/image/product_type/{{ $sp->image }}" alt=""></td>
							<td><a href="{{ route('productType.edit',$sp->id) }}" class="btn btn-outline-info">edit <i class="fas fa-edit"></i></a></td>
							<td>
								<form action="{{ route('productType.delete',$sp->id) }}" method="post">
									@method('DELETE')
									@csrf
									<button class="btn btn-outline-danger">delete <i class="fas fa-times"></i></button>
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
 </div>
@endsection