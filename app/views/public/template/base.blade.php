@extends('base')

@section('head')
		
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="website/images/favicon.png">
	{{HTML::style('website/css/bootstrap.min.css')}}
	{{HTML::style('website/css/media-queries.css')}}
	{{HTML::style('website/css/style.css')}}
	{{HTML::style('website/css/jquery.mmenu.css')}}
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

@stop



@section('body')
	
	<div id="wrap">
		@include('public.template.header')
		@yield('content')
	</div>
@include('public.template.footer')


@stop

@section('scripts')
    
	{{HTML::script('assets/jquery.min.js')}}
	{{HTML::script("website/js/bootstrap.min.js")}}
	{{HTML::script("website/js/jquery.mmenu.min.js")}}
	<script src='//code.jquery.com/ui/1.10.3/jquery-ui.js'></script>
	<script type="text/javascript">
	  jQuery(document).ready(function ($) {
	    $('nav#menu').mmenu();
	  });
	</script>

@stop