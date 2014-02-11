<?php

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class BaseModel extends Ardent{

	protected $iso_suffix = '_iso_date';

	protected $isodates = array();

	public function parseISODates()
	{
		foreach ($this->isodates as $field) {
			if(isset($this->{$field}) && strpos($this->{$field}, 'T') != false){
				$this->{$field} = date('Y:m:d H:i:s', strtotime($this->{$field}));
				// dd($field);
				// dd($this->{$field});
			}
		}
	}

	public function dateTimeToISO($field)
	{

		if(is_object($this->{$field}) && get_class($this->{$field}) == "Carbon\Carbon"){
			return $this->{$field}->toISO8601String();
		}
		else{
			return Carbon::parse($this->{$field})->toISO8601String();
		}
	}

	public function mutateDatesToISO()
	{
		foreach ($this->isodates as $field) {
			if(isset($this->{$field}) && !is_null($this->{$field})){
				$this->{$field.$this->iso_suffix} = $this->dateTimeToISO($field);
			}
		}
	}

	public function beforeSave()
	{
		$this->parseISODates();	}
	

	public function toArray()
	{
		$this->mutateDatesToISO(); //format date for angular-strap datepicker
		return parent::toArray();
	}
}