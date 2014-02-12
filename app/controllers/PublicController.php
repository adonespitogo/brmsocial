<?php

class PublicController extends BaseController{
	public function index()
	{
		return View::make('public.index');
	}

	public function product()
	{
		return View::make('public.product');
	}
}