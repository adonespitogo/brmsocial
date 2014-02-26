@extends('public.template.base')
@section('head')
	@parent
	<title>Products</title>
@stop

@section('content')
	<section class="deal-page bg-image-white">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="left-col">							
						<!-- Start Customers also bought -->
						<div class="row deal-popular">
							<h3>Category &rarr; {{ $category->category }}</h3>
							<div class="row deal-popular">

								@if(count($products) > 0)
									@foreach($products as $p)
										<div class="col-md-4 col-sm-4">
											@if(isset($p->pictures[0]))
												<a href="{{URL::to('product/'.$p->slug)}}">
													<img src='{{URL::to($p->pictures[0]->picture->url("medium"))}}' alt="most popular service" title="most popular service">
												</a>
											@endif
											<h4>
												<a href="{{URL::to('product/'.$p->slug)}}">
													{{$p->product_name}} <span>${{number_format($p->discounted_price, 2)}}</span>
												</a>
											</h4>
											<ul>
												<li>{{$p->getLeftSaleDays()}} days</li>
												<li><a href="#">{{$p->category->category}}</a></li>
											</ul>
										</div>
									@endforeach
								@else
									<div class="col-md-4 col-sm-4">No product yet.</div>
								@endif

							</div>
						</div>

						<!-- End Customers also bought -->
					</div>
				</div>
				<div class="col-md-4">
					<div class="right-col">
						<!-- Start Realated Sales -->
						@include('public.shared.related_sales')
						<!-- End Realated Sales -->
						<!-- Start Upcoming Sales -->
						@include('public.shared.upcoming_sales')
						<!-- End Upcoming Sales -->
					</div>
				</div>	
			</div>
		</div>
	</section>

@stop

@section('scripts')
	@parent
@stop