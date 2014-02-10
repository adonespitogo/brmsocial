@extends('base')

@section('head')
	<title>BRM Deals - Vendor</title>
    <link rel="stylesheet" href="bootstrap-3.1/css/bootstrap.min.css">
    {{stylesheet_link_tag('vendor')}}
@stop

@section('body')
	<div ng-app="VendorApp">
		<div ng-controller="MainVendorCtrl">
			@include('home.vendor.header')
			<div class="container" autoscroll='false' ui-view >
				
			</div>
		</div>
	</div>
	<hr>
	<footer style=" text-align: center; padding-bottom: 10px">
		BRM Deals &copy; 2014
	</footer>
@stop
@section('scripts')
	{{ javascript_include_tag('vendor') }}
@stop