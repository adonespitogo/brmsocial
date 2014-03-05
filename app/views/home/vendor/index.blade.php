@extends('base')

@section('head')
	<title>BRM Social - Vendor</title>
    <link rel="stylesheet" href="bootstrap-3.1/css/bootstrap.cosmo.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    {{stylesheet_link_tag('vendor')}}
@stop

@section('body')
	@include('home.shared.preloader')
	<div id="wrapper">
		<div ng-app="VendorApp">
			<div ng-controller="MainVendorCtrl">
				@include('home.vendor.header')
				<div style="padding: 10px 15px;" autoscroll='false' ui-view >
				
				</div>
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
	{{ javascript_include_tag('vendor') }}
@stop