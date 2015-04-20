<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartransRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chartrans_requests', function(Blueprint $table)
		{
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->smallInteger('state')->unsigned()->default(0);

            // destination server information
            $table->string('destination_realm');
            $table->integer('destination_account_id')->unsigned();
            $table->smallInteger('destination_character_race')->nullable();
            $table->smallInteger('destination_character_class')->nullable();
            $table->string('destination_character_equipment')->nullable();
            $table->integer('destination_character_profession')->nullable();

            // source server information
            $table->string('source_server_website')->nullable();
            $table->string('source_server_realm')->nullable();
            $table->string('source_server_expansion')->nullable();
            $table->string('source_server_account')->nullable();
            $table->string('source_server_character')->nullable();
            $table->text('source_server_account_characters')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('chartrans_requests');
	}

}
