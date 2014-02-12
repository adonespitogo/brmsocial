<?php

class PublicController extends BaseController{
	public function index()
	{
		$categories = Category::all();
		return View::make('public.index', array(
			'categories' => $categories
		));
	}
}