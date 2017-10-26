<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateProblemsTable creates migration for problems table.
 */
class CreateProblemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('problems', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('name', 20);
			$table->text('description');
			$table->integer('time_limit');
			$table->integer('memory_limit');
			$table->bigInteger('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->bigInteger('checker_id')->unsigned();
			$table->foreign('checker_id')->references('id')->on('checkers')->onDelete('cascade');
			$table->timestamps();
		});

		Schema::create('problem_prog_lang', function(Blueprint $table)
		{
			$table->bigInteger('problem_id')->unsigned();
			$table->foreign('problem_id')->references('id')->on('problems')
			      ->onDelete('cascade');

			$table->bigInteger('prog_lang_id')->unsigned();
			$table->foreign('prog_lang_id')->references('id')->on('prog_langs')
			      ->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('problem_prog_lang');
		Schema::drop('problems');
	}

}
