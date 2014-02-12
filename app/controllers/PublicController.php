<?php

class PublicController extends BaseController{
	public function index()
	{
		return View::make('public.index');
	}

	public function products()
	{
		return View::make('public.products');
	}
}