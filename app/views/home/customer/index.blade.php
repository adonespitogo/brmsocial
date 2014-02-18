@extends('base')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ URL::to('customer/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('customer/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('customer/css/media-queries.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('customer/css/style.css') }}">

@stop

@section('body')
   <div id="wrap">

       @include('home.customer.header')
       <div class="container-fluid"><!-- Start Container -->
            <div class="row">
                <div class="col-lg-2 col-md-3">
                <!-- Start Sidebar -->
                @include('home.customer.sidebar')
                </div>
                <div class="col-lg-7 col-md-6">
                <div class="content">
                  <h3 class="mb-30">Featured Deal of the week</h3> 
                  <div class="banner-home">
                    <img src="{{ URL::to('customer/images/banner-home.jpg') }}" alt="Featured Deal of the week" title="Featured Deal of the week">
                  </div>
                  <div class="form-sort form-inline pull-right">
                    <div class="form-group">
                      <label>Sort by:</label>
                      <select class="form-control w180">
                        <option>Categories</option>
                        <option>Date</option>
                        <option>Price</option>
                      </select>
                    </div>
                  </div>
                  <h3 class="mb-30">Recent Purchases</h3>
                  <!-- Start Recent Purchases -->
                  <div class="row recent-purchases">
                    <div class="col-md-3">
                      <img src="{{ URL::to('customer/images/recent-purchase-1.jpg') }}">
                    </div>
                    <div class="col-md-7">
                      <h4>Adobe Approved: The Night Photography Video Course</h4>
                      <p><a href="#"><em>By : KnowHow</em></a></p>
                      <a href="#" class="btn-download">Download</a>
                    </div>
                    <div class="col-md-2">
                      <span class="date"><em>January 20, 2014</em></span>
                    </div>
                  </div>
                  <!-- End Recent Purchases -->
                  <!-- Start Recent Purchases -->
                  <div class="row recent-purchases">
                    <div class="col-md-3">
                      <img src="{{ URL::to('customer/images/recent-purchase-1.jpg') }}">
                    </div>
                    <div class="col-md-7">
                      <h4>Adobe Approved: The Night Photography Video Course</h4>
                      <p><a href="#"><em>By : KnowHow</em></a></p>
                      <a href="#" class="btn-download">Download</a>
                    </div>
                    <div class="col-md-2">
                      <span class="date"><em>January 20, 2014</em></span>
                    </div>
                  </div>
                  <!-- End Recent Purchases -->
                  <!-- Start Recent Purchases -->
                  <div class="row recent-purchases">
                    <div class="col-md-3">
                      <img src="{{ URL::to('customer/images/recent-purchase-1.jpg') }}">
                    </div>
                    <div class="col-md-7">
                      <h4>Adobe Approved: The Night Photography Video Course</h4>
                      <p><a href="#"><em>By : KnowHow</em></a></p>
                      <a href="#" class="btn-download">Download</a>
                    </div>
                    <div class="col-md-2">
                      <span class="date"><em>January 20, 2014</em></span>
                    </div>
                  </div>
                  <!-- End Recent Purchases -->
                  <div class="rp-pagination">
                    <ul class="pagination pagination-sm">
                      <li><a href="#" class="active">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">5</a></li>
                    </ul>
                  </div>
                </div>
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
@stop
@section('scripts')
    <script type="text/javascript" src="customer/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
@stop