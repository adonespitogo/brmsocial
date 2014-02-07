@extends('home.template')

@section('head')
    @parent
    {{ stylesheet_link_tag('vendor') }}
@stop

@section('body')
   <div class="frame">
        
        @include('home.vendor.sidebar')

        <div class="content">
            @include('home.vendor.navbar')

            <div id="main-content">
                
            </div>
            
        </div>

        <div class="row footer">
            <div class="col-md-12 text-center">
                © 2013 <a href="http://bootstrapguru.com/">Bootstrap Guru</a>
            </div>
        </div>

   </div>
@stop
@section('scripts')
    {{ javascript_include_tag('vendor') }}
  
@stop