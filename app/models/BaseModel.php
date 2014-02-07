<?php

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class BaseModel extends Ardent{

	protected $jsdatefields = array();

	public function parseJSDate()
	{
		foreach ($this->jsdatefields as $field) {
			if(isset($this->{$field})){
				$this->{$field} = date('Y:m:d H:i:s', strtotime($this->{$field}));
			}
		}
	}

	public function beforeSave()
	{
		$this->parseJSDate();
	}

	public function mutateDatesToISO()
	{

		foreach ($this->jsdatefields as $field) {
			if(isset($this->{$field}) && !is_null($this->{$field})){
				$this->{$field} = Carbon::parse($this->{$field})->toISO8601String();
			}
		}
	}

	public function toArray()
	{
		$this->mutateDatesToISO(); //format date for angular-strap datepicker
		return parent::toArray();
	}
}