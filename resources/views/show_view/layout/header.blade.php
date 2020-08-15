
<div class="wrap">
		<!-- star form search -->
		<div class=" container search position-absolute">
			<form>
			  <div class="form-row">
			    <div class="form-group col-md-2">
			      <select name="loai_sp" id="inputState" class="form-control">
			      	<option value="0">tất cả sản phẩm</option>
			      	@foreach($loai_sp as $loai)
			        <option selected value="{{ $loai->id }}">{{ $loai->name }}</option>
			        @endforeach
			      </select>
			    </div>
			    <div class="form-group col-md-8">
			      	<input type="text" class="form-control" placeholder="search...">
			    </div>
			    <div class="col-md-2 float-right">
			  		<button type="submit" class="btn btn-danger w-100">search</button>
			    </div>
			  </div>
			</form>
		</div>
		<!-- end form search -->

		<!-- star header -->
		<div class="container-fluid top pt-4">
			<div class="row">
				<div class="d-none d-md-block col-md-12 col-lg-8"><h1 class=" text-white">THẾ GIỚI PHỤ KIỆN CÔNG NGHỆ</h1>
					<p class="font-weight-bold text-white">A: 151 Âu Cơ - Liên Chiểu -TP Đà Nẵng</p>
					<p class="font-weight-bold text-white">P: 0522-451-655 E: thuclinh854@gmail.com</p>
				</div>
				<!-- end col-8 -->
				<div class="form-top col-md-12 col-lg-4 mt-2">
					<table>
						<tr>
							<td>
								<button class="btn btn-outline-secondary " id="f-search"><i class="fas fa-search"></i></button>
							</td>
							@if(Auth::check())
							<td>
								<a href="{{ route('page.getUser') }}" class="btn btn-outline-light">chào bạn: {{ Auth::user()->nick_name }} </a>
							</td>
							<td>
								<form action="{{ route('page.logout') }}" method="post">
									@method('POST')
									@csrf
									<button class="btn btn-outline-danger">Sign out <i class="fas fa-sign-out-alt"></i></button>
								</form>
							</td>
							@else
							<td>
								<a href="{{ route('page.getSignin') }}" class="btn btn-outline-secondary">đăng ký <i class="far fa-user"></i></a>
							</td>
							<td>
								<a href="{{ route('page.getLogin') }}" class="btn btn-outline-info">Sign in <i class="fas fa-sign-in-alt"></i></a>
							</td>
							@endif
							<td>
								<a href="{{ route('cart.detail') }}" class=" btn btn-outline-danger"><i class="fas fa-cart-plus"></i>@if(Session::has('cart')){{ Session('cart')->totalQty }}@endif</a>
							</td>

						</tr>
					</table>
				</div>
			</div>

		</div>
		<!-- end top -->
		<div class="container-fluid header">
			<div class="row">
				<div class="col-12">
					<div class="menu-top">
						<nav class="navbar navbar-expand-lg navbar-primary|secondary|success|danger|warning|info|light|dark bg-primary|secondary|success|danger|warning|info|light|dark">
						  <a class="navbar-brand" href=""><span class="logo"></span></a>
						  <button class="navbar-toggler btn btn-outline-info" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						    <span class="fa fa-bars" aria-hidden="true"></span>
						  </button>
						
						  <div class="collapse navbar-collapse" id="navbarSupportedContent">
						    <ul class="navbar-nav mr-auto">
						      <li class="nav-item active">
						        <a class="nav-link" href="{{ route('page.index') }}"><i class="fas fa-home"></i></a>
						      </li>
						      <li class="nav-item dropdown">
						        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">sản phẩm</a>
						        <div class="dropdown-menu bg-info" aria-labelledby="navbarDropdown">
						        	@foreach($loai_sp as $loai)
						          <a href="{{ route('product.sp_theoloai',$loai->slug) }}" class="list-group-item font-weight-bold" style="width: 200px;" href="#">{{ $loai->name }}</a>
						          @endforeach
						        </div>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="#">công nghệ <i class="fas fa-business-time"></i></a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="#">thủ thuật máy tính <i class="fas fa-glasses"></i></a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="#">giới thiệu <i class="fas fa-info"></i></a>
						      </li>
						      
						    </ul>
						  </div>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<!-- end header -->
	</div>