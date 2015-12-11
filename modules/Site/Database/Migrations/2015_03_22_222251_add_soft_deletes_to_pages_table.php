<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSoftDeletesToPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_pages', function (Blueprint $table) {
            $table->dropColumn('active');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_pages', function (Blueprint $table) {
            $table->boolean('active');
            $table->dropSoftDeletes();
        });
    }
}
