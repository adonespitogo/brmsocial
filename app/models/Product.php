<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class Product extends Ardent implements UserInterface, RemindableInterface {

	protected $table = 'products';
	protected $softDelete = true;

	public function category() {
		return $this->belongsTo('Category');
	}

	public function user() {
		return $this->belongsTo('User');
	}

	public function orders() {
		return $this->hasMany('Order');
	}

	public function terms() {
		return $this->hasMany('Term');
	}

	public function featuredproducts() {
		return $this->hasMany('FeaturedProduct');
	}

}

?>