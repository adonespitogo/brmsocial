@extends('public.template.base')

@section('head')
	@parent

	<title>Deals</title>
@stop


@section('body')

@include('public.template.header')

<div id="wrap">
  	<section class="sp2-ordinary-page-title two-lines text-center">
	  <h1 class="fs-36">Build a bigger, more engaged audience with BRM Deals</h1>
	  <h2 class="fs-24">How Businesses are Pinpointing Profits</h2>
	</section>

	<section class="deal-page bg-image-white">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
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
					<div class="left-col">
						<h3>Most Popular Services</h3>
						<!-- Start Most Popular Services -->
						<div class="row deal-popular">
							<div class="col-md-4 col-sm-4">
								<img src='website/images/products/medium/img-cloudseekr.jpg' alt="most popular service" title="most popular service">
								<h4><a href="#">Design Your Dream Home With Live Interior 3D <span>$9.99</span></a></h4>
								<ul>
									<li>4 days</li>
									<li><a href="#">Productivity</a></li>
								</ul>
							</div>
							<div class="col-md-4 col-sm-4">
								<img src='website/images/products/medium/img-instagram.jpg' alt="most popular service" title="most popular service">
								<h4><a href="#">Design Your Dream Home With Live Interior 3D <span>$9.99</span></a></h4>
								<ul>
									<li>4 days</li>
									<li><a href="#">Productivity</a></li>
								</ul>
							</div>
							<div class="col-md-4 col-sm-4">
								<img src='website/images/products/medium/img-pinterest.jpg' alt="most popular service" title="most popular service">
								<h4><a href="#">Design Your Dream Home With Live Interior 3D <span>$9.99</span></a></h4>
								<ul>
									<li>4 days</li>
									<li><a href="#">Productivity</a></li>
								</ul>
							</div>
						</div>
						<!-- End Most Popular Services -->
					</div>
				</div>
				<div class="col-md-4">
					<div class="right-col">
						<h4>Sign Up and Get Notified</h4>
						<!-- Start Search -->
						<div class="deal-search">
							<form class="form-inline" role="form">
							  <div class="form-group">
							    <i class="icon icon-envelope"></i><input type="email" class="form-control no-br" placeholder="your@email.com">
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