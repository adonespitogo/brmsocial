
<!-- Start Upcoming Sales -->
<div class="upcoming-sales">
	<h4>Upcoming Sales</h4>
	<ul>
		@foreach(Product::getUpcomingSales() as $product)
			<li>
				<dl>
					<dt class="date">
						<div>
						{{date('d', strtotime($product->sale_start_date))}}
						</div>
						{{date('M', strtotime($product->sale_start_date))}}
					</dt>
					<dd>
						<a href="{{URL::to('product/'.$product->slug)}}">{{$product->product_name}}</a>
						<p>{{$product->tagline}}</p>
					</dd>
				<dl>
			</li>
		@endforeach
	</ul>
</div>
<!-- End Upcoming Sales -->
