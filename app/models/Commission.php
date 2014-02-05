<?php

	class Commission extends Eloquent {

		protected $table = 'commissions';

		public function user() {
			return $this->belongsTo('User');
		}

	}

?>