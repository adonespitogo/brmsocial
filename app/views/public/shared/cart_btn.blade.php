<?php
	$cartSummary = Cart::getCartSummary();
?>
<a href="{{ URL::to('cart') }}" ng-cloak class="ng-cloak">
	<div class="bg-cart">
	<span class="cart-dolsign">$</span>
	<span class="cart-price totalPrice" ng-bind="totalPrice">{{$cartSummary['totalPrice']}}</span>
	<i class="fa fa-shopping-cart"></i>
	<span class="cart-orders totalItem" ng-bind="numItem">{{$cartSummary['numItem']}}</span>
	</div>
</a>
