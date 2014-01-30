<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class Category extends Ardent implements UserInterface, RemindableInterface {

	protected $table = 'categories';
	protected $softDelete = true;

	public function products() {
		return $this->hasMany('Product');
	}
}

?>