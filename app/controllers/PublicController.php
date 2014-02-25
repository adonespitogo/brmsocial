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
 		
 		//event listener for product traffic		
 		new EventListener();
		Event::fire('product.traffic', $product);

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
	public function addSubscriber()
	{
		$error = false;
		$email = Input::get('email');
		$exist = DB::table('subscribers')->where('email', $email)->get();
		if($exist){
			$error = true;
		}
		else
		{
			DB::table('subscribers')->insert(array(
				array(
					'email' => $email,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
				)
			));
		}
		Session::flash('error', $error);
		return Redirect::to('/');
	}
}