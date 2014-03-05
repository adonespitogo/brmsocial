@extends('base')

@section('head')
	<title>BRM Deals - Admin</title>
    <link rel="stylesheet" href="bootstrap-3.1/css/bootstrap.cosmo.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    {{stylesheet_link_tag('admin')}}
@stop

@section('body')
	<div id="preloader"></div>
	<div id="wrapper">
		<div ng-app="AdminApp">
			<div ng-controller="MainAdminCtrl">
				@include('home.admin.header')
				
				<div class="" ui-view autoscroll='false' style="margin:30px;"></div>
			</div>
		</div>
		<hr>
		<footer style=" text-align: center; padding-bottom: 10px">
			BRM Deals &copy; 2014
		</footer>
	</div>
@stop
@section('scripts')
	{{ javascript_include_tag('preloader') }}
	{{ javascript_include_tag('admin') }}
@stop