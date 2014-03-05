@extends('base')

@section('head')
    {{ HTML::style('assets/lib/extras/preloader.css.scss') }}
    <title>BRM Social - Customer Portal</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::to('customer/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('customer/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('customer/css/media-queries.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('customer/css/style.css') }}">
    <div id="fb-root"></div>
@stop

@section('body')
  @include('home.shared.preloader')
   <div id="wrapper">
     <div id="wrap" ng-app="CustomerApp">
         <div ng-controller="MainCustomerCtrl">
           @include('home.customer.header')
           <div class="container-fluid"><!-- Start Container -->
                <div class="row">
                    <div class="col-lg-2 col-md-3">
                    <!-- Start Sidebar -->
                        @include('home.customer.sidebar')
                    </div>
           
                    <div class="col-lg-7 col-md-6" ui-view autoscroll="false">
                        
                    </div>
           
                  <div class="col-lg-3 col-md-3">
                  <!-- Start Right Column -->
                    @include('home.customer.right_sidebar')
                  </div>
                </div>
           </div>
           
           <!-- Start testimonials -->
           @include('home.customer.testimonials')
           @include('home.customer.footer')
          </div>
       </div>
   </div>
 </div>
@stop
@section('scripts')
    {{javascript_include_tag('customer')}}
@stop