@extends('public.template.base')
@section('html_tag_attributes')ng-app="Cart" ng-controller="cartCtrl" @stop
@section('head')
	@parent
	<title>Products</title>
@stop
@section('content')
<section class="checkout">	
	<div class="container pt-40" >
		<div class="row">
			<div class="col-md-12">
				<h3>Account</h3>
				<div class="co-wrapper ng-cloak" ng-cloak >
					 
					<table class="table">				        
				        <tbody>
							<tr>
								<td colspan="5">
									<form role="form">
									<div class="form-group">
									  @if(Auth::user())
								      	<label for="exampleInputEmail1">Email address</label>
									        <input type="email" placeholder="ie. yourname@domain.com" class="form-control br-0 buyer_email" value="{{Auth::user()->email}}" disabled>
								      @else
									      	<label for="exampleInputEmail1">Email address</label>
									        <input type="email" name="email" placeholder="ie. yourname@domain.com" ng-model="email"  ng-blur="saveEmail(email)" class="form-control br-0 buyer_email" data-original-title >
									   @endif
								    </div>
								    </form>
								</td>
							</tr>
							 
				          	<tr ng-repeat="item in cartItems" ng-class="item-@{{ item.id }}" ng-cloak class='ng-cloak'>  
					            <td class="co-prod">
									<img ng-src="@{{item.product_picture}}">
									<h4 ng-bind="item.product.product_name"></h4>
									<i class="fa fa-video-camera"></i><a href="#" ng-bind="item.product.type.type"></a>
					            </td>
					            <td class="co-rprice">
									<div class="co-title">Regular Price</div>
									<span ng-bind="'$ '+item.product.regular_price"></span>
					            </td>
					            <td class="co-discount">
									<div class="co-title">Discount</div>
									<span ng-bind="item.discount_percentage+'%'"></span>
					            </td>
					            <td class="co-price">
									<div class="co-title">Price</div>
									<span ng-bind="'$'+item.product.discounted_price"></span>
					            </td>
					            <td class="co-remove">
									<a href="javascript:void(0)" ng-click="remove(item)"><i class="fa fa-times"></i></a>
					            </td>
				          	</tr>
  

				        </tbody>
				    </table>
				     
				    <div class="alert alert-warning" ng-show="numItem<=0">Your cart is empty</div>
					 
				</div>  
				<div class="row ng-cloak" ng-cloak ng-show="numItem>0">
					 
					<div class="col-md-12">
						<div class="co-total clearfix">
							<ul class="co3-total-row">
				                <li class="co3-total">
				                    TOTAL
				                    <div><span>$</span><span ng-bind="totalPrice">0</span>.00</div>
				                </li>
				                
				                <li class="pull-right hidden-xs">
				                    <a href="{{URL::to('payment/go-pay/paypal')}}" id="payWithPaypal" class="btn-green btn-co3-step2 confirm-checkout-btn" ng-hide="!hasValidEmail"><img src="{{URL::to('website/images/co3-btn-paypal.png')}}" alt="paypal" title="paypal"> Pay with Paypal</a>
				                </li>
				                <li class="pull-right hidden-xs" ng-hide="!hasValidEmail"><div class="co3-or img-circle">OR</div></li>
				                <li class="pull-right hidden-xs">
				                    <a href="{{URL::to('payment/go-pay/credit-card')}}" id="payWithCreditCard" class="btn-green btn-co3-step2 confirm-checkout-btn" ng-hide="!hasValidEmail"><img src="{{URL::to('website/images/co3-btn-other-credit-cards.png')}}" alt="paypal" title="paypal"> Pay with Credit card</a>
				                </li>
				                <li class="pull-right visible-xs btn-paynow">
				                    <a href="{{URL::to('payment/go-pay/paypal')}}" class="btn-green btn-co3-step2 confirm-checkout-btn" ng-hide="!hasValidEmail">
				                        <span>Pay Now <img src="{{URL::to('website/images/img-pay-now.png')}}" alt="paypal" title="paypal"></span>
				                    </a>
				                </li>				                
				            </ul>
						</div>
					</div>
					 
				</div>

				
				<div class="co-wrapper" style="padding:30px">
			        <div class="row mb-20 hidden-xs">
			            <div class="col-md-7 pad-10-40">
			                <div class="co-promise">
			                    <div class="title">Our promise</div>
			                    <ul>
			                        <li><span>We do not store any of your sensitive credit card information on our servers; it stays with our merchant processor (Paypal), who is PCI Compliant. Even though we don't store any sensitive data, we take security seriously and we are also PCI Compliant.</span></li>
			                        <li><span>If you are having trouble processing payment, please fill out a <span>support request</span> and we'll be happy to help out.</span></li>
			                    </ul>
			                </div>
			            </div>
			            <div class="col-md-5 co-paypal">
			                <p>To complete your order, you will be redirected to PayPal.</p>
			                <a href="#"><img src="{{URL::to('website/images/co3-paypal.jpg')}}" alt="paypal" title="paypal"></a>
			            </div>
			        </div>

			        <div class="row">
						<div class="col-md-12">
							<div class="co-testimonial">
								<ul>
									<li><img src="{{URL::to('website/images/co-testimonial-avatar1.jpg')}}" alt="paypal" title="paypal"></li>
									<li>
										<p><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star"></i></p>
										<p>
											WOW! I got the course I’m dying to have in just a minute, so fast transaction and easy process. I would really recommed your site to my friends, Usefull stuff are here.  One thing that bothering me is that, maybe I could add funds/credits instead of going to paypal everytime I buy. The rest are perfect 
										</p>
										<p class="co-author">Allan, Graveris</p>
									</li>
									<li><img src="{{URL::to('website/images/co-testimonial-avatar2.jpg')}}" alt="paypal" title="paypal"></li>
									<li>
										<p><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i></p>
										<p>I really love the quality of the videos, it’s erally clear plus the vendors on your site are experts. I believe you really choosed it wisely. Also, I love the simplicity of the site interms of buying and delivering the services. Everything is great for me. Keep up!</p>
										<p class="co-author">Grace , Draws</p>
									</li>
								</ul>
							</div>
						</div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</section> 


@stop

@section('scripts')
	@parent
	{{javascript_include_tag('cart')}}
@stop