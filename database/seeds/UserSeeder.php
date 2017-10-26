<?php

use Illuminate\Database\Seeder;

use GoodlerJudge\User;

/**
 * UserSeeder seeds users table with initial data.
 */
class UserSeeder extends Seeder {

	/**
	 * Seed users table.
	 *
	 * @return void
	 */
	public function run()
	{
		User::create([
			'name'     => 'admin',
			'email'    => 'goodler.judge@gmail.com',
			'password' => bcrypt('admin'),
			'username' => 'admin',
		]);
	}

}
