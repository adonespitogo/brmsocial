<?php

use LaravelBook\Ardent\Ardent;

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

}