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
 		$order = Order::where('product_id', $product->id)->first();

 		$orderExist = (is_object($order) && $order->max_download>$order->download_count) ? true : false;
 		//event listener for product traffic		
 		
		if(is_object($product)){
				
			Event::fire('product.traffic', $product);

			return View::make('public.product')->with(array('product'=> $product, 'orderExist'=>$orderExist/*boolean*/));
		}
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

	public function free(){
			$products = Product:://where('regular_price', '<=', 0)
								where('discounted_price', '<=', 0)
								->get();

			return View::make('public.product_list', [
					'products' => $products
				])->with('category', json_decode(json_encode(array('category'=>'Free')), FALSE));
	}
}