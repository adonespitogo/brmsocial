@foreach(Product::getMostPopular() as $index => $p)

		@if(($index % 3 + 1) == 1)
			<div class="row deal-popular">
		@endif
		
		<div class="col-md-4 col-sm-4">
			@if(isset($p->pictures[0]))

				<a href="{{URL::to('product/'.$p->slug)}}">
					<img src='{{URL::to($p->pictures[0]->picture->url("medium"))}}' alt="most popular service" title="most popular service">
				</a>

			@endif
			
			<h4>
			<a href="{{URL::to('product/'.$p->slug)}}">
			
			{{$p->product_name}}
			
			@if($p->discounted_price > 0)
				<span>${{number_format($p->discounted_price, 2)}}</span>
			@else
				<span class="free">$0.00</span>
			@endif
			 
			</a></h4>
			<ul>
				<li>{{$p->getLeftSaleDays()}} days</li>
				<li><a href="{{URL::to('products/category/'.$p->category->slug)}}">{{$p->category->category}}</a></li>
			</ul>
		</div>
	@endforeach

</div>