<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class Order extends Ardent implements UserInterface, RemindableInterface {

	protected $table = 'orders';
	protected $softDelete = true;

	public function user() {
		return $this->belongsTo('User');
	}

	public function product() {
		return $this->belongsTo('Product');
	}

}

?>