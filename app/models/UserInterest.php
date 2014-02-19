<?php

	class UserInterest extends Eloquent {

		protected $table = 'user_interests';

		public function user() {
			return $this->belongsTo('User');
		}

	}

?>