<?php

use Illuminate\Database\Seeder;

use Symfony\Component\Filesystem\Filesystem;

use GoodlerJudge\TestCase;

/**
 * ProblemSeeder seeds problems table with initial data.
 */
class TestCaseSeeder extends Seeder {

	/**
	 * Seed problems table.
	 *
	 * @return void
	 */
	public function run()
	{
		$tc = TestCase::create([
			'problem_id' => 1,
		]);
		$fs = new Filesystem;
		$fs->copy(
			app_path() . '/TestEngine/example/test.in.1',
			storage_path() . "/app/$tc->dir$tc->input_file"
		);
		$fs->copy(
			app_path() . '/TestEngine/example/test.out.1',
			storage_path() . "/app/$tc->dir$tc->checker_data"
		);
	}

}
