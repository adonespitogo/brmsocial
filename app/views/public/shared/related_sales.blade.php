<div class="related-deals">
	<h4>Related Deals</h4>
	<ul>
		@foreach(Product::all() as $product)
			<li>
				<img src='{{URL::to($product->pictures[0]->picture->url("small"))}}' alt="related deals" title="related deals">
				<div><a href="#">{{$product->product_name}}</a></div>
				<div class="price">${{$product->discounted_price}}</div>
				<ul>
					<li>{{$product->getLeftSaleDays()}} days</li>
					<li><a href="#">{{$product->category->category}}</a></li>
				</ul>
			</li>
		@endforeach
	</ul>
</div>