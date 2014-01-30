<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class Term extends Ardent implements UserInterface, RemindableInterface {

	protected $table = 'terms';
	protected $softDelete = true;

	public function product() {
		return $this->belongsTo('Product');
	}

}

?>