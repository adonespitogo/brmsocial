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
			</div>
		</div>
	</div>
</section> 


@stop

@section('scripts')
	@parent
	{{HTML::script("website/js/add-order.js")}}
@stop