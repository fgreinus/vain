<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupportCategoriesContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_categories_content', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('category_id')->unsigned();
            $table->string('name', 50);
            $table->string('locale', 2);

            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('support_categories')->onDelete('cascade');
            $table->unique(['category_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('support_categories_content');
    }
}
