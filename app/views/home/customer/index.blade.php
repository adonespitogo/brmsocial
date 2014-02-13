@extends('base')

@section('head')
    {{ stylesheet_link_tag('customer') }}
@stop

@section('body')
   <div ng-app="CustomerApp">

        <div ng-controller="MainCtrl">
            Nav
            <ul>
                <li><a >Home</a></li>
                <li><a >Home</a></li>
                <li><a >Home</a></li>
            </ul>
            
            <div ui-view>
                
            </div>
        </div>

   </div>
@stop
@section('scripts')
    {{ javascript_include_tag('customer') }}
@stop