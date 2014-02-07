<?php

	class Traffic extends Eloquent {

		protected $table = 'product_traffic';

		public function product() {
			return $this->belongsTo('Product');
		}

	}
?>