<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_articles_content', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned();
            $table->string('locale', 2);
            $table->string('name', 50);
            $table->string('keywords');
            $table->string('description');
            $table->text('text');

            $table->timestamps();

            $table->foreign('article_id')->references('id')->on('support_articles')->onDelete('cascade');
            $table->unique(['article_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('support_articles_content');
    }
}
