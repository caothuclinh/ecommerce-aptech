<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	<base href="{{ asset('') }}">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">  
	<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
	<script src="https://cdn.ckeditor.com/ckeditor5/21.0.0/classic/ckeditor.js"></script>
	

	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script type="text/javascript" src="soucre/vendor/bootstrap.js"></script>
	<script type="text/javascript" src="soucre/vendor/jquery.js"></script>
	<script type="text/javascript" src="soucre/vendor/all.js"></script>
 	<script type="text/javascript" src="soucre/2.js"></script>
	<link rel="stylesheet" href="soucre/vendor/bootstrap.css">
	<link rel="stylesheet" href="soucre/vendor/all.css">
 	<link rel="stylesheet" href="soucre/2.css">
 </head>
 <body>
 	@if(Route::currentRouteName() != 'admin.index')
 	@include('admin/layout/header')
 	@endif
 	{{-- end menu --}}
 	<div class="content">
 		@section('content')
 		@show
 		
 	</div>
	
 </body>
 </html>