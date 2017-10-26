<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateProgLangsTable creates migration for prog_langs table.
 */
class CreateProgLangsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prog_langs', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('compile_cmd');
			$table->string('run_cmd');
			$table->string('extension');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('prog_langs');
	}

}
