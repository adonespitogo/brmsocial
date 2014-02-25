<div class="related-deals">
	<h4>Related Deals</h4>
	<ul>
		@foreach(Product::all() as $product)
			<li>
				@if(isset($product->pictures[0]))
				<a href="{{URL::to('product/'.$product->slug)}}">
				<img src='{{URL::to($product->pictures[0]->picture->url("small"))}}' alt="related deals" title="related deals">
				</a>
				@endif
				<div><a href="{{URL::to('product/'.$product->slug)}}">{{$product->product_name}}</a></div>
				<div class="price">${{$product->discounted_price}}</div>
				<ul>
					<li>{{$product->getLeftSaleDays()}} days</li>
					<li><a href="{{URL::to('category/'.$product->category->slug)}}">{{$product->category->category}}</a></li>
				</ul>
			</li>
		@endforeach
	</ul>
</div>