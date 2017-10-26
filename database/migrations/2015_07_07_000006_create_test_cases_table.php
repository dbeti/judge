<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTestCasesTable creates migration for test_cases table.
 */
class CreateTestCasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('test_cases', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('problem_id')->unsigned();
			$table->foreign('problem_id')->references('id')
			                             ->on('problems')
			                             ->onDelete('cascade');
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
		Schema::drop('test_cases');
	}

}
