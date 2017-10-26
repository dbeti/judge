<?php

use Illuminate\Database\Seeder;

use GoodlerJudge\Problem;

/**
 * ProblemSeeder seeds problems table with initial data.
 */
class ProblemSeeder extends Seeder {

	/**
	 * Seed problems table.
	 *
	 * @return void
	 */
	public function run()
	{
		Problem::create([
			'name' => 'SUM',
			'description' => 'Write a program that adds two integers.',
			'time_limit' => 1,
			'memory_limit' => 16,
			'user_id' => 1,
			'checker_id' => 1
		]);
	}

}
