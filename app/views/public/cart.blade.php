@extends('public.template.base')
@section('head')
	@parent
	<title>Products</title>
	<base href="{{URL::to('/')}}" />
@stop
@section('content')
<section class="checkout">	
	<div class="container pt-40">
		<div class="row">
			<div class="col-md-12">
				<h3>Account</h3>
				<div class="co-wrapper">
					<table class="table">				        
				        <tbody>
							<tr>
								<td colspan="5">
									<form role="form">
								      <div class="form-group">
								        <label for="exampleInputEmail1">Email address</label>
								        <input type="email" placeholder="ie. yourname@domain.com" class="form-control br-0">
								      </div>
								    </form>
								</td>
							</tr>
				          	<tr>
					            <td class="co-prod">
									<img src="http://localhost/brmsocial/public/website/images/img-customer1.jpg">
									<h4>Rank Up Your Youtube Videos On First Page of Google</h4>
									<i class="fa fa-video-camera"></i><a href="#">video course</a>
					            </td>
					            <td class="co-rprice">
									<div class="co-title">Regular Price</div>
									<span>$230</span>
					            </td>
					            <td class="co-discount">
									<div class="co-title">Discount</div>
									<span>10%</span>
					            </td>
					            <td class="co-price">
									<div class="co-title">Price</div>
									<span>$159</span>
					            </td>
					            <td class="co-remove">
									<a href="#"><i class="fa fa-times"></i></a>
					            </td>
				          	</tr>
				        </tbody>
				    </table>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="co-total clearfix">
							<ul class="co3-total-row">
				                <li class="co3-total">
				                    TOTAL
				                    <div><span>$</span><span class='cart_total'></span>100.00</div>
				                </li>
				                
				                <li class="pull-right hidden-xs">
				                    <a href="javascript:void(0)" class="btn-green btn-co3-step2 confirm-checkout-btn"><img src="http://localhost/brmsocial/public/website/images/co3-btn-paypal.png" alt="paypal" title="paypal"> Pay with Paypal</a>
				                </li>
				                <li class="pull-right hidden-xs"><div class="co3-or img-circle">OR</div></li>
				                <li class="pull-right hidden-xs">
				                    <a href="javascript:void(0)" class="btn-green btn-co3-step2 confirm-checkout-btn"><img src="http://localhost/brmsocial/public/website/images/co3-btn-other-credit-cards.png" alt="paypal" title="paypal"> Pay with Credit card</a>
				                </li>
				                <li class="pull-right visible-xs btn-paynow">
				                    <a href="javascript:void(0)" class="btn-green btn-co3-step2 confirm-checkout-btn">
				                        <span>Pay Now <img src="http://localhost/brmsocial/public/website/images/img-pay-now.png" alt="paypal" title="paypal"></span>
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
			                <a href="#"><img src="http://localhost/brmsocial/public/website/images/co3-paypal.jpg" alt="paypal" title="paypal"></a>
			            </div>
			        </div>

			        <div class="row">
						<div class="col-md-12">
							<div class="co-testimonial">
								<ul>
									<li><img src="http://localhost/brmsocial/public/website/images/co-testimonial-avatar1.jpg" alt="paypal" title="paypal"></li>
									<li>
										<p><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star"></i></p>
										<p>
											WOW! I got the course I’m dying to have in just a minute, so fast transaction and easy process. I would really recommed your site to my friends, Usefull stuff are here.  One thing that bothering me is that, maybe I could add funds/credits instead of going to paypal everytime I buy. The rest are perfect 
										</p>
										<p class="co-author">Allan, Graveris</p>
									</li>
									<li><img src="http://localhost/brmsocial/public/website/images/co-testimonial-avatar2.jpg" alt="paypal" title="paypal"></li>
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
	{{HTML::script("website/js/add-order.js")}}
@stop