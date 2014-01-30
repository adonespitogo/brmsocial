<?php

class VendorsTableSeeder extends Seeder {
	

	public function run()
	{
		Eloquent::unguard();

		DB::table('users')->where('email', 'pitogo.adones@gmail.com')->delete();
		User::insert(
			array(
				array(
					'id' => 1,
					'email' => 'pitogo.adones@gmail.com',
					'password' => Hash::make('123456'),
					'is_vendor' => true,
					'firstname' => 'Adones',
					'lastname' => 'Pitogo',
					'profile_img' => 'default_vendor.jpg',
				),
			)
		);
		//create vendorinfo for user
		DB::table('vendor_info')->where('user_id', 1)->delete();
		VendorInfo::insert(
			array(
				array(
					'id' => 1,
					'user_id' => 1,
					'company_name' => 'Naif, Inc.',
					'website_url' => 'http://www.adonesp.com',
				)
			)
		);

	}

}