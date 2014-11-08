<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitialMigration extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		// Create group table
		Schema::create('group', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('mesi_id');
			$table->string('name', 16)->unique();
		});

		// Create schedule table
		Schema::create('schedule', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('group_id')->unsigned()->nullable();
			$table->timestamps();
			$table->foreign('group_id')->references('id')->on('group')->onDelete('cascade');
		});

		// Create pair table
		Schema::create('pair', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('schedule_id')->unsigned();
			$table->enum('week', array('even', 'odd'));
			$table->integer('day')->unsigned();
			$table->integer('num')->unsigned();
			$table->string('name', 64);
			$table->string('teacher', 64);
			$table->string('type', 32);
			$table->string('location', 32);
			$table->foreign('schedule_id')->references('id')->on('schedule')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('group');
		Schema::drop('schedule');
		Schema::drop('pair');
	}

}
