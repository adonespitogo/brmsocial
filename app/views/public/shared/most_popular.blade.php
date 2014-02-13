<div class="row deal-popular">
	@foreach(Product::getMostPopular() as $p)
		<div class="col-md-4 col-sm-4">
			<img src='{{URL::to($p->pictures[0]->picture->url("medium"))}}' alt="most popular service" title="most popular service">
			<h4><a href="{{URL::to('product/'.$p->slug)}}">{{$p->product_name}} <span>$9.99</span></a></h4>
			<ul>
				<li>4 days</li>
				<li><a href="#">Productivity</a></li>
			</ul>
		</div>
	@endforeach
</div>