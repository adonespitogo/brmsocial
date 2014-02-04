@extends('base')

@section('head')
    <link rel="stylesheet" href="bootstrap-3.1/css/bootstrap.min.css">
    {{stylesheet_link_tag('admin')}}
@stop

@section('body')
	
@stop
@section('scripts')
	{{ javascript_include_tag('admin') }}
    @parent
@stop