<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateGroupsTable creates migration for groups table.
 */
class CreateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('group_user', function(Blueprint $table)
		{
			$table->bigInteger('group_id')->unsigned();
			$table->foreign('group_id')->references('id')->on('groups')
			      ->onDelete('cascade');

			$table->bigInteger('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')
			      ->onDelete('cascade');
		});

		Schema::create('group_problem', function(Blueprint $table)
		{
			$table->bigInteger('group_id')->unsigned();
			$table->foreign('group_id')->references('id')->on('groups')
			      ->onDelete('cascade');

			$table->bigInteger('problem_id')->unsigned();
			$table->foreign('problem_id')->references('id')->on('problems')
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
		Schema::drop('group_user');
		Schema::drop('group_problem');
		Schema::drop('groups');
	}

}
