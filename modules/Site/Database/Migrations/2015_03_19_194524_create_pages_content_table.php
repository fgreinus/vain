<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesContentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages_content', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->string('locale', 2);
            $table->string('title', 50);
            $table->string('keywords');
            $table->string('description');
            $table->text('text');
            $table->timestamps();

            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pages_content');
	}

}
