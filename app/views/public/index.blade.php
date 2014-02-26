@extends('public.template.base')

@section('head')
	@parent

	<title>BRM Social</title>	
@stop


@section('body')

@include('public.template.header')

<div id="wrap">
  	<section class="sp2-ordinary-page-title two-lines text-center">
	  <h1 class="fs-36">Build a bigger, more engaged audience with BRM Deals</h1>
	  <h2 class="fs-24">How Businesses are Pinpointing Profits</h2>
	  <div class="social-header">
	  	<ul>
		  	<li><a href="#" class="fb"><i class="fa fa-facebook"></i><span>sign up with facebook</span></a></li>
		  	<li><span>or</span></li>
		  	<li><a href="#" class="twit"><i class="fa fa-twitter"></i><span>sign up with twitter</span></a></li>
	  	</ul>	  	
	  </div>
	  <div class="via-email">Sign up via E-Mail</div>
	</section>

	<section class="deal-page bg-image-white">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					@if(isset($featured)&&isset($featured->product)&&isset($featured->product->pictures[0]))
					<div class="left-col">
						<h3>Featured Deal</h3>
						<!-- Start Featured Deal -->
						<div class="banner-deal-page">
							<img src='{{URL::to($featured->product->pictures[0]->picture->url())}}' alt="featured deal" title="featured deal">
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="featured-title">{{$featured->product->product_name}}</div>
								<div class="featured-price">
									<ul>
										<li>now only</li>
										<li>${{number_format($featured->product->discounted_price, 0)}}<span>.00</span></li>
									</ul>
								</div>
							</div>
							<div class="col-sm-6 text-right">
								<div class="reg-price">
									<span>${{number_format($featured->product->regular_price, 0)}}</span><br />
									regular price
								</div>
								<span class="save">save {{$featured->product->getDiscountPercentage()}}%</span>
							</div>
						</div>
						<!-- End Featured Deal -->
					</div>
					@endif
					<div class="left-col">
						<h3>Most Popular Services</h3>
						<!-- Start Most Popular Services -->
						@include('public.shared.most_popular')
						<!-- End Most Popular Services -->
					</div>
				</div>
				<div class="col-md-4">
					<div class="right-col">
						<h4>Sign Up and Get Notified</h4>
						<!-- Start Search -->
						<div class="deal-search">
							@if(Session::has('error') && Session::get('error'))
								<div class="alert alert-danger">
									This email is already subscribed to our newsletter.
								</div>
							@endif
							@if(Session::has('error') && !Session::get('error'))
								<div class="alert alert-success">
									You have successfully subscribed to our newsletter.
								</div>
							@endif
							
							<form class="form-inline" role="form" action="{{URL::to('subscribe')}}" method="POST">
							  <div class="form-group">
							    <i class="icon icon-envelope"></i><input name="email" type="email" class="form-control no-br" placeholder="your@email.com">
							  </div>
							  <button type="submit" class="btn btn-green btn-default no-br">Submit</button>
							</form>
						</div>
						<!-- End Search -->
						<!-- Start Realated Sales -->
						@include('public.shared.related_sales')
						<!-- End Realated Sales -->
						@include('public.shared.upcoming_sales')
					</div>
				</div>			
			</div>
		</div>
	</section>
</div>

<div id="footer">
</div>

@stop

@section('scripts')
	@parent
@stop