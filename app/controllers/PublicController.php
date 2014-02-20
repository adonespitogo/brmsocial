<?php

class PublicController extends BaseController{
	public function index()
	{
		$featured = FeaturedProduct::getFeaturedProductToday();

		return View::make('public.index', array(
			'featured' => $featured
		));
	}

	public function product($slug)
	{	 
		$product = Product::where('slug', $slug)->first();
 
		if(is_object($product))
			return View::make('public.product')->with('product', $product);
		else
			return $this->show404();
	}
	
	public function categoryProducts($slug)
	{
		$c = Category::where('slug', $slug)->first();
		if(is_object($c))
			return Product::getByCategory($c);
		else
			$this->show404();
	}
}