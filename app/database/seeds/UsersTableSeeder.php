<?php

class UsersTableSeeder extends Seeder {
	

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
					'type' => 'vendor',
					'firstname' => 'Adones',
					'lastname' => 'Pitogo',
					'profile_img' => 'default_vendor.jpg'
				),
				array(
					'id' => 2,
					'email' => 'jon@gmail.com',
					'password' => Hash::make('123456'),
					'type' => 'admin',
					'firstname' => 'Jonathan',
					'lastname' => 'Kennedy',
					'profile_img' => 'default_vendor.jpg'
				),
				array(
					'id' => 3,
					'email' => 'revalderc@gmail.com',
					'password' => Hash::make('123456'),
					'type' => 'customer',
					'firstname' => 'Romnick',
					'lastname' => 'Revalde',
					'profile_img' => 'default_vendor.jpg'
				),
				array(
					'id' => 4,
					'email' => 'arnel.lenteria@gmail.com',
					'password' => Hash::make('1'),
					'type' => 'customer',
					'firstname' => 'Arnel',
					'lastname' => 'Lenteria',
					'profile_img' => 'default_vendor.jpg'
				)
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