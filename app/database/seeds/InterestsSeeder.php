<?php

	class InterestsSeeder extends Seeder {

		public function run() {
			
			Eloquent::unguard();

			Interest::insert(

				array(
					array(
						'id' => 1,
						'interest' => 'Designer Resources'
						),
					array(
						'id' => 2,
						'interest' => 'Music'
						),
					array(
						'id' => 3,
						'interest' => 'Apple Accessories'
						),
					array(
						'id' => 4,
						'interest' => 'Windows Software'
						),
					array(
						'id' => 5,
						'interest' => 'Gaming'
						),
					array(
						'id' => 6,
						'interest' => 'Web'
						),
					array(
						'id' => 7,
						'interest' => 'Mac Software'
						),
					array(
						'id' => 8,
						'interest' => 'Movies'
						),
					array(
						'id' => 9,
						'interest' => 'Gadgets'
						),
					array(
						'id' => 10,
						'interest' => 'Productivity Tools'
						),
					array(
						'id' => 11,
						'interest' => 'Entrepreneur'
						),
					array(
						'id' => 12,
						'interest' => 'Android Apps'
						),
					array(
						'id' => 13,
						'interest' => 'Giveaways'
						),
					array(
						'id' => 14,
						'interest' => 'iOS Apps'
						),
					array(
						'id' => 15,
						'interest' => 'Freebies'
						),
					array(
						'id' => 16,
						'interest' => 'Video Tutorials'
						)
					)
				);

		}

	}

?>