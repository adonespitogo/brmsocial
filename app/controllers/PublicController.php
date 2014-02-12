<?php

class PublicController extends BaseController{
	public function index()
	{
		return View::make('public.index');
	}

	public function product($slug)
	{
		$product = Product::where('slug', $slug)->first();
		if(is_object($product))
			return View::make('public.product')->with('product', $product);
		else
			return $this->show404();
	}
}