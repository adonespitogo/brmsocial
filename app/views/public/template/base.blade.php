@extends('base')

@section('head')
		
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="website/images/favicon.png">
	<link href="website/css/bootstrap.min.css" rel="stylesheet">
	<link href="website/css/media-queries.css" rel="stylesheet">
	<link href="website/css/style.css" rel="stylesheet">
	<link href="website/css/jquery.mmenu.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

@stop



@section('body')

@stop



@section('scripts')
    
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="website/js/bootstrap.min.js"></script>
	<script src='//code.jquery.com/ui/1.10.3/jquery-ui.js'></script>
	<script src="website/js/jquery.mmenu.min.js"></script>
	<script type="text/javascript">
	  jQuery(document).ready(function ($) {
	    $('nav#menu').mmenu();
	  });
	</script>

@stop