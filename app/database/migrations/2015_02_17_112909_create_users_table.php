<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
		$table->increments('id');
		$table->string('email')->unique();
		$table->string('username');
		$table->string('password');
		$table->string('password_temp');
		$table->string('code');
		$table->integer('active');
		$table->enum('isAdmin', array(0,1))->default(0);
		$table->string('photo');
		$table->timestamps();
		$table->string('remember_token');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
