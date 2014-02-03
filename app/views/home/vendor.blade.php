@extends('base')

@section('head')
	{{stylesheet_link_tag('vendor')}}
@stop

@section('body')
    <div ng-app="VendorApp">
    	<div ng-controller="MainCtrl">

    		<h1>Welcome @{{currentUser.fullname}}</h1>
    		<h4>Nav</h4>
    		<ul>
    			<li>
    				<a ui-sref="vendor">Dashboard</a>
    			</li>
    			<li>
    				<a ui-sref="products">Products</a>
    			</li>
    		</ul>
    		
    		<div ui-view>
    			
    		</div>
    		
    	</div>
    </div>
@stop
@section('scripts')
	{{ javascript_include_tag('vendor') }}
@stop