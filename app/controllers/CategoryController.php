<?php

	class CategoryController extends BaseController {

		public function getIndex($id=null)
		{	
			if($id)
				return Category::find($id);
			else
				return Category::all();
		}	 
		public function putIndex($id=null){

			$id = ($id) ? $id : Input::get('id');
			$cat = Category::find($id); 
			$cat->category = Input::get('category');
			$cat->update();
			return 1;
		}
		public function deleteIndex($id=null){
			$cat = Category::find($id);
			$cat->delete();
			return 1;
		}

	}

?>