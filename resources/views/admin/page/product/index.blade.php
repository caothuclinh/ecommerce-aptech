@extends('admin.layout.master')
@section('title',' sản phẩm')
@section('content')
<div class="wrapper bg-light">
@component('admin.layout.components')
	danh sách sản phẩm
@endcomponent
@if (Session::has('mesage'))
	{{-- expr --}}
	<div class="containern">
		<div class="row">
			<div class="col alert alert-{{ Session::get('flag') }}">{{ Session::get('mesage') }}</div>
		</div>
	</div>
@endif
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php $i =0;?>
				<table class="table table-hover table-inverse">
					<thead>
						<tr>
							<th>STT</th>
							<th>id</th>
							<th>name <i class="fas fa-file-signature"></i></th>
							<th>giá</th>
							<th colspan="3">số lượng</th>
							<th>image</th>
							<th colspan="3" class="text-center">query</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0;?>
						@foreach($sanpham as $sp)
						<?php $lenght = $sp->quantity;?>
						<?php $i++;?>
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $sp->id }}</td>
							<td>{{ $sp->name }}</td>
							<td>{{ $sp->unit_price }}</td>

							@if($lenght <= 0)
							<td >
								<button type="submit" class="btn">-</button>
							</td>
							@else
							<td >
								<form action="{{ route('product.minus',$sp->id) }}" method="post">
								@method('POST')
								@csrf
								<button type="submit" class="btn btn-outline-secondary">-</button>
								</form>
							</td>
							@endif
							<td>
								<p class="d-inline">{{ $sp->quantity }} </p>
							</td>
							<td>
								<form action="{{ route('product.plush',$sp->id) }}" method="post">
									@method('POST')
									@csrf
									<button type="submit" class="btn btn-outline-success">+</button>
								</form>
							</td>
							
							<td><img height="50" width="50" src="soucre/image/product/{{ $sp->image }}" alt=""></td>
							{{-- <td><a href="" class="btn btn-outline-info">chi tiết</a></td> --}}
							<td><a href="{{ route('product.edit',$sp->id) }}" class="btn btn-outline-secondary">edit <i class="fas fa-edit"></i></a></td>
							<td>
								<form action="{{ route('product.destroy',$sp->id) }}" method="post">
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
			{{-- end col --}}
		</div>
		{{-- end row --}}
		{!!   $sanpham->links() !!}
	</div>
 </div>
<script>
	$(document).ready(function(){
		$(document).on('click','.pagination a',function(event){
			event.preventDefault();
			var page = $(this).attr('href').split('page=')[1];
			fetch_data(page);
		});
		function fetch_data(page){
			$.ajax({
				url: 'admin/product?page='+page,
				type: 'GET',
				success: function(data){
					$('body').html(data);
					// console.log(data);
				}
			});
		}
	});
</script>
@endsection