<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSourceServerTypeToChartransRequestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('chartrans_requests', function(Blueprint $table)
		{
			$table->boolean('source_server_type')->default(NULL)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('chartrans_requests', function(Blueprint $table)
		{
			$table->dropColumn('source_server_type');
		});
	}

}
