<?php

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class BaseModel extends Ardent{

	protected $iso_suffix = '_iso_date';

	protected $isodates = array();

	protected function createSlug($string, $force_lowercase = true, $anal = false) {
	    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "=", "+", "[", "{", "]", "_",
	                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
	                   "â€”", "â€“", ",", "<", ".", ">", "/", "?");
	    $clean = trim(str_replace($strip, "", strip_tags($string)));
	    $clean = preg_replace('/\s+/', "-", $clean);
	    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
	    return ($force_lowercase) ?
	        (function_exists('mb_strtolower')) ?
	            mb_strtolower($clean, 'UTF-8') :
	            strtolower($clean) :
	        $clean;
	}

	public function makeSlug()
	{
		if(isset($this->hasSlug) && !empty($this->hasSlug)){
			$slug_col = $this->hasSlug['slugColumn'];
			$slug_from_col = $this->hasSlug['slugFromColumn'];
			$this->{$slug_col} = $this->createSlug($this->{$slug_from_col});
		}
	}

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
		$this->parseISODates();
		$this->makeSlug();
	}
	

	public function toArray()
	{
		$this->mutateDatesToISO(); //format date for angular-strap datepicker
		return parent::toArray();
	}
}