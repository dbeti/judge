<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSolutionsTable creates migration for solutions table.
 */
class CreateSolutionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('solutions', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('user_id')->unsigned();
			$table->foreign('user_id')->references('id')
			                          ->on('users')
			                          ->onDelete('cascade');
			$table->bigInteger('problem_id')->unsigned();
			$table->foreign('problem_id')->references('id')
			                             ->on('problems')
			                             ->onDelete('cascade');
			$table->bigInteger('prog_lang_id')->unsigned();
			$table->foreign('prog_lang_id')->references('id')
			                               ->on('prog_langs')
			                               ->onDelete('cascade');
			$table->string('status', 20);
			$table->float('total_time')->nullable();
			$table->float('max_memory')->nullable();
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
		Schema::drop('solutions');
	}

}
