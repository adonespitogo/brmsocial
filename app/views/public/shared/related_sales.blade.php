<div class="related-deals">
	<h4>Related Deals</h4>
	<ul>
		@foreach(Product::getUpcomingSales() as $product)
			<li>
				<img src='{{URL::to("website/images/products/small/img-cloudseekr.jpg")}}' alt="related deals" title="related deals">
				<div><a href="#">{{$product->product_name}}</a></div>
				<div class="price">${{$product->discounted_price}}</div>
				<ul>
					<li>4 days</li>
					<li><a href="#">{{$product->category->category}}</a></li>
				</ul>
			</li>
		@endforeach
	</ul>
</div>