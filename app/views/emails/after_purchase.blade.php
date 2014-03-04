@extends('base')

@section('head')

@stop

@section('body')
 
<p>Hi @if(is_object($cartItems[0]->user)){{$cartItems[0]->user->firstname}} @else {{$cartItems[0]->buyer_email}} @endif,</p>
<br>
<p>Phew! What a relief.</p> 
<p>
	Your orders of @foreach ($cartItems as $key => $cartItem) {{$cartItem->product->product_name}} @if($key!=count($cartItems)-1) {{','}} @endif @if($key==count($cartItems)-2){{'and'}} @endif @endforeach went through smooth as silk. Now it is high time for our hardworking gnomes to get to work!
	Your campaign will start in 48 to 72 hours or sooner.
</p>

<p>
	We will send an email to let you know when your campaign ends or you can just login to your account to track and manage your orders at
	{{HTML::link('/')}}
</p>

<p>Let's review the details of your order:</p>

<p>
	@foreach ($cartItems as $key => $cartItem) 
		<b>{{$cartItem->product->product_name}}</b><br>
		Transaction ID: {{$orderItems[$key]['txn_id']}}<br> 
		Price: {{$orderItems[$key]['price']}}<br>

		<br>
	@endforeach	 
	
</p>
<p>
	Did we get that right? Great.
	Now you can make the order placement shebang a whole lot easy breezy next time by adding funds to your account. Skip the long line at Paypal and just purchase with a single click, we promise! No forms to fill out, no hassles at the shopping counter. One click and you're done.
	A trick you didn't know, eh?
</p>
<p>
Well, we be off now. Thanks for choosing Buy Real Marketing. Have an awesome day!
</p>
<p>
Catch ya later,
<br>
Team Buy Real Marketing
</p>
@stop