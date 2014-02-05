<?php

	class CategoryController extends BaseController {

		public function getIndex()
		{	
			return Category::all();
		}	 
		public function putIndex($id){
			$cat = Category::find($id);
			$cat->save(Input::get());
			return 1;
		}

	}

?>