<?php

use Illuminate\Database\Seeder;

use GoodlerJudge\ProgLang;

/**
 * ProgLangsSeeder seeds prog_langs table with initial data.
 */
class ProgLangSeeder extends Seeder {

	/**
	 * Seed prog_langs table.
	 *
	 * @return void
	 */
	public function run()
	{
		ProgLang::create([
			'name' => 'C',
			'compile_cmd' => 'gcc -o %2$s %1$s',
			'run_cmd' => './%1$s',
			'extension' => 'c'
		]);
	}

}
