@extends('public.template.base')
@section('head')
	@parent
	<title>Products</title>
	<base href="{{URL::to('/')}}" />
@stop
@section('content')

	<section>
		Cart here...
	</section>


@stop

@section('scripts')
	@parent
	{{HTML::script("website/js/add-order.js")}}
@stop