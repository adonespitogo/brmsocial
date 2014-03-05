<?php

	class ProductController extends BaseController {

		public function index()
		{
			$products = Product::all();

			foreach ($products as $p) {
				$p->loadPicture();
			}

			return $products;
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
			$p->max_download = Input::get('max_download');

			$type = Input::get('type');
			$p->type = $type->id;

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
			if(!empty($terms)&&$terms!==''){
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

			$type = Input::get('type');
			$p->type = $type['id'];
			
			$p->max_download = Input::get('max_download');
			$p->user_id  = Input::get('user_id');
			$p->save();

			if(Input::get('is_featured')){
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
				
				if(!empty($terms)&&$terms!=''){
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
			if(Input::has('product_file') && Input::get('product_file')){ 
				ProductFile::where('product_id','=', $p->id)->delete();
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

		public function postAddFile(){ 
			$pf = new ProductFile();
			$pf->file = Input::file('file');
			$pf->product_id = Input::get('id');
			$pf->save();
			return 1;
		}

		public function destroy($id)
		{
			Product::where('id', $id)->delete();
			ProductPicture::where('product_id', $id)->delete();
			FeaturedProduct::where('product_id', $id)->delete();
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

		public function featuredProduct() {
			$featuredproduct = FeaturedProduct::getFeaturedProduct();

			foreach($featuredproduct as $f) {
				$f->loadPicture();
			}

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

		public function getDownload($orderId, $productId, $productFileIndex){
			$order = Order::find($orderId);
			$user = Auth::user();

			if(is_object($order)&&$order->user_id == $user->id && $order->max_download >= $order->download_count){
				
				$product = $order->product;
				if(!isset($product->files[$productFileIndex]))
					return Response::json(array('status'=>404, 'error'=>'file not found'), 404);

				$order->download_count += 1;
				$order->save();

				$productFile = $product->files[$productFileIndex];
				$filepath = app_path('storage').$productFile->file->url();
				 
				return Response::download($filepath);
				
			}else{
				return Response::json(array('status'=>403, 'error'=>'Forbidden'), 403);
			}
		}

		public function countProducts(){
			return Product::count();
		}

		public function activateFree(){
			$productId = Input::get('id');

			if(!Session::has('free_steps_completed')){
				Session::put('free_steps_completed', array($productId));
				return 1;
			}
			else{
				Session::push('free_steps_completed', $productId);
				return 1;
			}
		}

		public function deactivateFree(){
			$session = Session::get('free_steps_completed');
			$productId = Input::get('id');
			if(Session::has('free_steps_completed') && is_array($session) && in_array($productId, $session)){
				
				for ($i = 0, $l = count($session); $i < $l; ++$i) {
			        if (in_array($productId, $session)) unset($session[$i]);
			    }				

				Session::put('free_steps_completed', $session);

				return 1;
			}
		}
	}

?>