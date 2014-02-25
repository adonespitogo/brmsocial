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
								@if(isset($product->pictures[0]))
								<img src='{{URL::to($product->pictures[0]->picture->url())}}' alt="featured deal" title="featured deal">
								@endif
							</div>
							<!-- End Featured Deal -->
						</div>
						<div class="product-tabs">
							<ul class="nav nav-tabs" id="myTab">
					            <li><a href="#overview">Overview</a></li>
					        </ul>
					    </div>
						<div class="left-col">
							<!-- Start of Overview and Comments -->
							<div id="overview">
								{{$product->overview}}
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
								<h4 class="clearfix">{{ is_object($product->user->vendorInfo) ? $product->user->vendorInfo->company_name : $product->user->firstname . ' ' . $product->user->lastname }}</h4>
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
								<div class="terms-of-sale">
									<h4>Terms of Sale</h4>
									<ul class="fa-ul">
									@foreach($product->terms as $index=>$t)
										<li><i class="fa-li fa fa-star-o"></i>{{$t->term}}</li> 
									@endforeach
									</ul>
								</div>
								<div class="question-box">
									<p class="lead"><span>Questions?</span> We'd love to help!<i class="fa fa-umbrella fa-lg"></i></p>
									<small>Email or chat M-F, 9am-5pm PST;</small>
									<small><a href="mailto:support@buyrealmarketing.com">support@buyrealmarketing.com</a></small>
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