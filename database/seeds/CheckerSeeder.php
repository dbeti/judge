<?php

use Illuminate\Database\Seeder;

use Symfony\Component\Filesystem\Filesystem;

use GoodlerJudge\Checker;

/**
 * CheckerSeeder seeds checkers table with initial data.
 */
class CheckerSeeder extends Seeder {

	/**
	 * Seed checkers table.
	 *
	 * @return void
	 */
	public function run()
	{
		$checker = Checker::create([
			'shared' => true,
			'user_id' => 1,
			'name' => "probni",
			'prog_lang_id' => 1,
		]);

		$fs = new Filesystem;
		$fs->copy(
			app_path() . '/TestEngine/example/words_checker.c',
			storage_path() . "/app/$checker->source_dir$checker->source_name"
		);
	}
}

