<div class="related-deals">
	<h4>Related Deals</h4>
	<ul>
		@foreach(Product::all() as $product)
			<li class="clearfix">
				@if(isset($product->pictures[0]))
					<div class="l-img">
					<a href="{{URL::to('product/'.$product->slug)}}">
						<img src='{{URL::to($product->pictures[0]->picture->url("small"))}}' alt="related deals" title="related deals">
					</a>
					</div>
				@endif
				<div class="r-details">
					<div><a href="{{URL::to('product/'.$product->slug)}}">{{$product->product_name}}</a></div>
					<div class="price">
						@if($product->discounted_price > 0)
							${{$product->discounted_price}}
						@else
							<span class="free">$0.00</span>
						@endif
					</div>
					<ul>
						<li><i class="fa fa-clock-o"></i>{{$product->getLeftSaleDays()}} days</li>
						<li><a href="{{URL::to('category/'.$product->category->slug)}}">{{$product->category->category}}</a></li>
					</ul>
				</div>
			</li>
		@endforeach
	</ul>
</div>