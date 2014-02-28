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
								      	<input type="hidden" class="cart_id" {{ isset($_COOKIE['cart_session_id']) ? $_COOKIE['cart_session_id'] : '' }} />
								        <label for="exampleInputEmail1">Email address</label>
								        <input type="email" placeholder="ie. yourname@domain.com" class="form-control br-0 buyer_email">
								      </div>
								    </form>
								</td>
							</tr>
							@foreach($cart_items as $item)
				          	<tr class="item-{{ $item->id }}">
					            <td class="co-prod">
									<img src="{{URL::to($item->product->pictures[0]->picture->url())}}">
									<h4>{{ $item->product->product_name }}</h4>
									<i class="fa fa-video-camera"></i><a href="#">video course</a>
					            </td>
					            <td class="co-rprice">
									<div class="co-title">Regular Price</div>
									<span>${{ $item->product->regular_price }}</span>
					            </td>
					            <td class="co-discount">
									<div class="co-title">Discount</div>
									<span>{{ $item->product->getDiscountPercentage() }}%</span>
					            </td>
					            <td class="co-price">
									<div class="co-title">Price</div>
									<span>${{ $item->product->discounted_price }}</span>
					            </td>
					            <td class="co-remove">
									<a href="javascript:void(0)" onclick="removeItem({{ $item->id }})"><i class="fa fa-times"></i></a>
					            </td>
				          	</tr>

				          	@endforeach

				        </tbody>
				    </table>
				</div>
			</div>
		</div>
	</div>
</section> 


@stop

@section('scripts')
	@parent
	{{HTML::script("website/js/add-order.js")}}
	{{HTML::script("website/js/cart.js")}}
@stop