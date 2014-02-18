<?php

	class ProductController extends BaseController {

		public function index()
		{
			return Product::all();
		}

		public function create()
		{
			$p = new Product();
			$p->featured_start_date_iso_date = "2014-02-17T07:46:16+0000";
			$p->featured_end_date_iso_date = "2014-02-17T07:46:16+0000";
			$p->featured_start_date = '2014:02:17 07:19:23';
			$p->featured_end_date = '2014:02:17 07:19:23'; 
			return $p;
		}

		public function store()
		{

			$p = new Product();
			$p->category_id = Input::get('category');
			$p->product_name = Input::get('product_name');
			$p->tagline = Input::get('tagline');
			$p->regular_price = Input::get('regular_price');
			$p->discounted_price = Input::get('discounted_price');
			$p->sale_start_date = Input::get('sale_start_date_iso_date');
			$p->sale_end_date = Input::get('sale_end_date_iso_date');
			$p->product_image = Input::get('product_image');
			$p->overview = Input::get('overview');
			$p->user_id = Input::get('user');
			$p->save();

			if(Input::has('is_featured') && Input::get('is_featured')){
				$fp = new FeaturedProduct();
				$fp->product_id = $p->id;
				$fp->featured_start_date = Input::get('featured_start_date_iso_date');
				$fp->featured_end_date = Input::get('featured_end_date_iso_date');
				$fp->save();
			}
			 
			$terms = Input::get('terms');
			if(!empty($terms)){
				$terms = explode(',', $terms);
				if(count($terms)>0){
					foreach($terms as $i=>$tx){
						if(trim($tx)=='')
							continue;
						$t = new Term();
						$t->product_id = $p->id;
						$t->term = $tx;
						$t->save();
					}
				}
			}			

			return $p;
		}

		public function show($id)
		{	
			return Product::find($id);
		}

		public function update($id)
		{
			$p = Product::find($id);
			$c = Input::get('category');
			$p->category_id = $c['id'];
			$p->product_name = Input::get('product_name');
			$p->tagline = Input::get('tagline');
			$p->regular_price = Input::get('regular_price');
			$p->discounted_price = Input::get('discounted_price');
			$p->sale_start_date = Input::get('sale_start_date_iso_date');
			$p->sale_end_date = Input::get('sale_end_date_iso_date');
			$p->product_image = Input::get('product_image');
			$p->overview = Input::get('overview');
			$user= Input::get('user');
			$p->user_id  = $user['id'];
			$p->save();

			if(Input::has('featured') && Input::get('is_featured')){
				$f = Input::get('featured');
				
				if(isset($f['id']))
					$fp = FeaturedProduct::find($f['id']);
				
				if(!isset($fp->id))
					$fp = new FeaturedProduct();
	
				$fp->product_id = $p->id;				
				$fp->featured_start_date = $f['featured_start_date_iso_date'];
				$fp->featured_end_date = $f['featured_end_date_iso_date'];
				$fp->save();
			}else{
				$fp = FeaturedProduct::where('product_id','=',$p->id);
				$fp->delete();
			}

			$terms = Input::get('terms');

			if(!is_array($terms)){
				Term::where('product_id','=', $p->id)->delete(); 
				
				if(!empty($terms)){
					$terms = explode(',', $terms);
					if(count($terms)>0){
						foreach($terms as $i=>$tx){
							if(trim($tx)=='')
								continue;
							$t = new Term();
							$t->product_id = $p->id;
							$t->term = $tx;
							$t->save();
						}
					}
				}
			}

			if(Input::has('product_image') && Input::get('product_image')){ 
				ProductPicture::where('product_id','=', $p->id)->delete();
			}
			return $p;
		}

		public function postAddImage(){
			$id = Input::get('id');
			$pi = new ProductPicture();
			$pi->picture = Input::file('file');
			$pi->product_id = $id;
			$pi->save();
			return 1;
		}

		public function destroy($id)
		{
			Product::where('id', $id)->delete();
		}

		public function myProducts()
		{
			return Auth::user()->products;
		}

		public function featuredProducts()
		{

			$featuredproduct = FeaturedProduct::getFeaturedProducts();
			return $featuredproduct;

		}

		public function myActiveProducts() {
			return Auth::user()->getMyActiveProducts();
		}

		public function myActiveProductsCount() {
			$count = Auth::user()->getMyActiveProductsCount();
			return Response::json(array('count' => $count));
		}

		public function productTraffic($id) {

			$product = Product::find($id);

			$product->loadProductTraffic();
			
			return $product;
		}


	}

?>