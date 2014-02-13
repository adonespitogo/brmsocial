@extends('public.template.base')
@section('head')
	@parent
	<title>Products</title>
@stop
@section('body')
  	@include('public.template.header')
    <div id="wrap">
      	<!--script>
		// $('#myTab a[href="#overview"]').tab('show')
		</script-->
		<section class="sp2-ordinary-page-title two-lines text-center">
		  <h1 class="fs-36">{{$product->product_name}}</h1>
		  <h2 class="fs-24">{{$product->tagline}}</h2>
		</section>

		<section class="deal-page bg-image-white">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<div class="left-col">
							<!-- Start Featured Deal -->
							<div class="banner-deal-page">
								<img src='{{URL::to($product->pictures[0]->picture->url())}}' alt="featured deal" title="featured deal">
							</div>
							<!-- End Featured Deal -->
						</div>
						<div class="product-tabs">
							<ul class="nav nav-tabs" id="myTab">
					            <li><a href="#overview">Overview</a></li>
					            <li><a href="#class_comments">Comments</a></li>
					        </ul>
					    </div>
						<div class="left-col">
							<!-- Start of Overview and Comments -->
							<div id="overview">
								<p class="pt-30">Pinterest is exploding on the scene of not only Social Media but Business marketing online or internet marketing. In this course I want to teach you the basics of Pinterest, how to create niche boards, how to leverage Pinterest for business, tips and techniques to drive free traffice to your business or website, the philosophy behind the social media platform, why people will spread your message and a few advanced secrets as well.</p>
								<p class="pt-30">In this course we will include everything that you need in order to master Pinterest. This course should take you no longer than a few hours to complete and then a few more hours to work around the site and set things up. In less than 5 hours you can be in a whole new level with Pinterest and you can start to drive free traffic.</p>
								<p class="pt-30">The course is structured from the beginning basics to the more advanced stuff as we progress but nothing in this course is too advanced. All information is quality but most people can perform it and the advanced will learn a thing or two as well.</p>
								<p class="pt-30">You will want to take this course if you need tons of free traffic, need to grow a business, want to make extra money or if you just want to learn to master the basics of Pinterest.</p>

								<div class="category-wrapper">
									<p class="pt-60">
										<span>Category:</span> 
										{{$product->category->category}}
									</p>

									<h4 class="pt-30">What are the requirements?</h4>
									<ul>
									  <li>Need to have a basic Pinterest account set up</li>
									</ul>

									<h4 class="pt-30">What am I going to get from this course?</h4>
									<ul>
									  <li>Over 16 lectures and 2.5 hours of content!</li>
									  <li>Learn how to drive a ton of free traffic to your business</li>
									  <li>Understand some advanced strategies</li>
									</ul>

									<h4 class="pt-30">What is the target audience?</h4>
									<ul>
									  <li>Anyone interested in learning Pinterest with minimal computer & technical ability (ie:able to do things on Facebook or Pinterest)</li>
									  <li>People looking to make money with Pinterest</li>
									</ul>
								</div>
							</div>
							<div id="class_comments">
								<P>3 Comments</P>
							</div>
							<div>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							</div>
							<!-- End of Overview and Comments -->
						</div>
						<div class="left-col">
							<h3>Customers also bought</h3>
							<!-- Start Customers also bought -->
							<div class="row deal-popular">
								@include('public.shared.most_popular')
							</div>
							<!-- End Customers also bought -->
						</div>
					</div>
					<div class="col-md-4">
						<div class="right-col">
							<div class="product-right-col clearfix">
								<div class="featured-price">
									<ul>
										<li>now only</li>
										<li>${{(int)$product->discounted_price}}<span>.00</span></li>
									</ul>
								</div>
								<div class="reg-price text-right">
									<span>${{(int)$product->regular_price}}</span><br />
									regular price
									<h2></h2>
								</div>
								<div class="clearfix"><span class="save pull-right">save {{$product->getDiscountPercentage()}}%</span></div>
								<h4 class="clearfix">By Blue Anatomy, Ltd.</h4>
								<div class="progress">
								  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$product->getEndDatePercentage()}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$product->getEndDatePercentage()}}%">
								    <span class="sr-only">
								    {{$product->getEndDatePercentage()}}% Complete (success) 
								    </span>
								  </div>
								</div>
								<ul class="clearfix">
									<li class="pull-left fs-10">Started
									{{date("M d", strtotime($product->sale_start_date))}}
									</li>
									<li class="pull-right fs-10">Ends
									{{date("M d", strtotime($product->sale_end_date))}}
									</li>
								</ul>
								<h3 class="text-center first-h3"><i class="fa fa-time"></i>  Sale ends in <span>{{$product->getLeftSaleDays()}} days</span></h3>
								<button class="btn-green">BUY NOW</button>
								<div class="img-or">{{image_tag('img-or.jpg', array('alt' => 'or'))}}</div>
								<div class="gift-style"><h3 class="text-center second-h3"><i class="fa fa-gift fa fa-large"></i>    Gift this</h3></div>
								<div class="terms-of-sale">
									<h4>Terms of Sale</h4>
									<ul class="fa-ul">
									  <li><i class="fa-li fa fa-calendar"></i>30 day money back guarantee!</li>
									  <li><i class="fa-li fa fa-clock-o"></i>Lifetime access! No limits!</li>
									  <li><i class="fa-li fa fa-mobile-phone"></i>iPhone, iPad and Android Accessibility</li>
									  <li><i class="fa-li fa fa-trophy"></i>Certificate of completion</li>
									</ul>
								</div>
								<div class="question-box">
									<p class="lead"><span>Questions?</span> We'd love to help!<i class="fa fa-umbrella fa-lg"></i></p>
									<small>Email or chat M-F, 9am-5pm PST;</small>
									<small><a href="#">support@buyrealmarketing.com</a></small>
								</div>
							</div>
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
    </div>

    <div id="footer">
    </div>

@stop

@section('scripts')
	@parent
@stop