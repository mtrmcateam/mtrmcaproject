<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellbookTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sell_book', function($table)
		{
		$table->increments('id');
		$table->string('user_id');
		$table->string('book_name');
		$table->string('author_name');
		$table->string('book_edition');
		$table->string('print_year');
		$table->string('book_condition');
		$table->string('isbn');
		$table->string('publisher');
		$table->string('category');
		$table->string('mrp');
		$table->string('selling_price');
		$table->text('book_description');
		$table->string('photo');
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
		Schema::drop('sell_book');
	}

}
