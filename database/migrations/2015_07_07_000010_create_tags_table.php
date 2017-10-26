<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTagsTable creates migration for tags table.
 */
class CreateTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tags', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('name');
			$table->text('description');
			$table->timestamps();
		});

		Schema::create('problem_tag', function(Blueprint $table)
		{
			$table->bigInteger('problem_id')->unsigned();
			$table->foreign('problem_id')->references('id')->on('problems')
			      ->onDelete('cascade');

			$table->bigInteger('tag_id')->unsigned();
			$table->foreign('tag_id')->references('id')->on('tags')
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
		Schema::drop('problem_tag');
		Schema::drop('tags');
	}

}
