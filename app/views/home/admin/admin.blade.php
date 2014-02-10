@extends('base')

@section('head')
	<title>BRM Deals - Admin</title>
    <link rel="stylesheet" href="bootstrap-3.1/css/bootstrap.min.css">
    {{stylesheet_link_tag('admin')}}
@stop

@section('body')
	<div ng-app="AdminApp">
		<div ng-controller="MainAdminCtrl">
			@include('home.admin.header')
			<div class="container" ui-view autoscroll='false' ></div>
		</div>
	</div>
	<hr>
	<footer style=" text-align: center; padding-bottom: 10px">
		BRM Deals &copy; 2014
	</footer>
@stop
@section('scripts')
	{{ javascript_include_tag('admin') }}
@stop