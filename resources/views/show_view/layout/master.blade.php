<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	<base href="{{ asset('') }}">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">  
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	{{-- <script src="https://cdn.ckeditor.com/ckeditor5/21.0.0/classic/ckeditor.js"></script> --}}

	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	
	<link rel="stylesheet" href="soucre/vendor/bootstrap.css">
	<link rel="stylesheet" href="soucre/vendor/all.css">
 	<link rel="stylesheet" href="soucre/1.css">
</head>
<body>
	<div class="wrapper">
	</div>
	@include('show_view/layout/header')
	{{-- end header --}}
	<div class="content">
		@section('content')
		@show
	</div>
	<!-- end content -->
	{{-- footer --}}
	@include('show_view/layout/footer')
</div>
<!-- end wrapper -->
<script type="text/javascript" src="soucre/vendor/bootstrap.js"></script>
<script type="text/javascript" src="soucre/vendor/jquery.js"></script>
<script type="text/javascript" src="soucre/vendor/all.js"></script>
	<script type="text/javascript" src="soucre/1.js"></script>

</body>
</html>
</html>
