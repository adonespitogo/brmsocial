<?php

	class Interest extends Eloquent {

		protected $table = 'interests';

		public function users() {
			return $this->belongsToMany('User');
		}

	}

?>