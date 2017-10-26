<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCheckersTable creates migration for checkers table.
 */
class CreateCheckersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('checkers', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->bigInteger('prog_lang_id')->unsigned();
			$table->foreign('prog_lang_id')->references('id')
			      ->on('prog_langs');
			$table->string('name', 20);
			$table->boolean('shared');
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
		Schema::drop('checkers');
	}

}
