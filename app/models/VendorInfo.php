<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class VendorInfo extends Ardent implements UserInterface, RemindableInterface {

	protected $table = 'vendor_info';
	protected $softDelete = true;

	public function user() {
		return $this->belongsTo('User');
	}

}

?>