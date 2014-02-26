<div class="row deal-popular">


	@foreach(Product::getMostPopular() as $p)
		<div class="col-md-4 col-sm-4">
			@if(isset($p->pictures[0]))

				<a href="{{URL::to('product/'.$p->slug)}}">
					<img src='{{URL::to($p->pictures[0]->picture->url("medium"))}}' alt="most popular service" title="most popular service">
				</a>

			@endif
			
			<h4>
			<a href="{{URL::to('product/'.$p->slug)}}">
			{{$p->product_name}} <span>${{number_format($p->discounted_price, 2)}}</span>
			</a></h4>
			<ul>
				<li>{{$p->getLeftSaleDays()}} days</li>
				<li><a href="{{URL::to('categories/'.$p->category->slug)}}">{{$p->category->category}}</a></li>
			</ul>
		</div>
	@endforeach

</div>