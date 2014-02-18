@extends('base')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('customer/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('customer/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('customer/css/media-queries.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('customer/css/style.css') }}">

@stop

@section('body')
   <div id="wrap" ng-app="CustomerApp">

       <div ng-controller="MainCustomerCtrl">
         @include('home.customer.header')
         <div class="container-fluid"><!-- Start Container -->
              <div class="row">
                  <div class="col-lg-2 col-md-3">
                  <!-- Start Sidebar -->
                      @include('home.customer.sidebar')
                  </div>
         
                  <div class="col-lg-7 col-md-6" ui-view>
                      
                  </div>
         
                <div class="col-lg-3 col-md-3">
                <!-- Start Right Column -->
                @include('home.customer.right_sidebar')
                </div>
              </div>
         </div>
         
         <!-- Start testimonials -->
         @include('home.customer.testimonials')
         </div>
         @include('home.customer.footer')
          <?php
              // echo '<pre>';
              // print_r(Auth::user());
              // echo '</pre>';
         
          ?>
            </div>
       </div>
@stop
@section('scripts')
    {{javascript_include_tag('customer')}}
    <script type="text/javascript" src="customer/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
@stop