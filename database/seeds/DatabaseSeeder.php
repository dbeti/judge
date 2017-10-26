<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use GoodlerJudge\UserSeeder;

/**
 * DatabaseSeeder runs all database seeds.
 */
class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$this->call('UserSeeder');
		$this->call('ProgLangSeeder');
		$this->call('CheckerSeeder');
		$this->call('ProblemSeeder');
		$this->call('TestCaseSeeder');
	}

}
