@extends('home.template')

@section('head')
    <title>BRMSocial::Vendor's Portal</title>
    @parent    
    {{ stylesheet_link_tag('vendor') }}
@stop

@section('body')

    <section id="container" ng-app="VendorApp" ng-controller="MainVendorCtrl">
        @include('home.vendor.header')
        @include('home.vendor.sidebar')
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper" ui-view>
                <!--mini statistics start-->
            </section>
        </section>
        @include('home.vendor.rightsidebar')
    </section>

@stop
@section('scripts')
    {{ javascript_include_tag('vendor') }}
    @parent
@stop