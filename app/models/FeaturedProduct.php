<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class FeaturedProduct extends Ardent implements UserInterface, RemindableInterface {

	protected $table = 'featured_products';
	protected $softDelete = true;

	public function product() {
		return $this->belongsTo('Product');
	}

}

?>