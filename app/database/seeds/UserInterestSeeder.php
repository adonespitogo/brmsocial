<?php

	class UserInterestSeeder extends Seeder {

		public function run() {

			Eloquent::unguard();

			UserInterest::insert(
				array(
					array(
							'id' => 1,
							'user_id' => 3,
							'interest_id' => 3
						),
					array(
							'id' => 2,
							'user_id' => 3,
							'interest_id' => 4
						),
					array(
							'id' => 3,
							'user_id' => 3,
							'interest_id' => 5
						),
					array(
							'id' => 4,
							'user_id' => 3,
							'interest_id' => 6
						),
					array(
							'id' => 5,
							'user_id' => 3,
							'interest_id' => 7
						),
					array(
							'id' => 6,
							'user_id' => 3,
							'interest_id' => 8
						)
					)
				);

		}

	}

?>