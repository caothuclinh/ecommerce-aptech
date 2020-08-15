<button class="navb btn btn-outline-danger position-fixed"><i class="fas fa-bars"></i></button>
 	{{-- menu --}}
	<div class="menu position-fixed bg-dark">
		<h2 class="text-center text-white">ecommerce menu</h2>
		<hr>
		<a href="{{ route('page.index') }}" class="btn btn-block btn-outline-info">view front end</a>
		<div class="khoi w-100">
			<h4 class="pl-3 text-white pt-2 pb-2 btn-block btn text-left">Loại sản phẩm <i class="fas fa-chevron-down"></i></h4>
			<ul  class="down">
				<li class="p-3 mb-1"><a href="{{ route('productType.index') }}" class="text-white">Danh sách</a></li>
				<li class="p-3 mb-1"><a href="{{ route('productType.create') }}" class="text-white">Thêm mới</a></li>
			</ul>
		</div>
		{{-- end mot khoi --}}
		<div class="khoi w-100">
			<h4 class="pl-3 text-white  pt-2 pb-2 btn-block btn text-left">sản phẩm <i class="fas fa-chevron-down"></i></h4>
			<ul  class="down">
				<li class="p-3 mb-1"><a href="{{ route('product.index') }}" class="text-white">Danh sách</a></li>
				<li class="p-3 mb-1"><a href="{{ route('product.create') }}" class="text-white">Thêm mới</a></li>
			</ul>
		</div>
		{{-- end mot khoi --}}
		
		
	</div>
 	{{-- end menu --}}