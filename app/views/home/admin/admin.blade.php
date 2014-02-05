@extends('base')

@section('head')
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
@stop
@section('scripts')
	{{ javascript_include_tag('admin') }}
@stop