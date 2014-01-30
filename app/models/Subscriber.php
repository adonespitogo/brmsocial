<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class Subscriber extends Ardent implements UserInterface, RemindableInterface {

	protected $table = 'subscribers';
	protected $softDelete = true;
}

?>