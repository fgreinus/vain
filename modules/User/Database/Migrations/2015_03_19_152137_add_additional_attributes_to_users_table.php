<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddAdditionalAttributesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('alias', 50)->unique();
            $table->date('birthday_at');
            $table->enum('gender', ['male', 'female'])->nullable();

            $table->string('city', 50);
            $table->string('profession', 50);
            $table->string('hobbies');
            $table->text('about');

            $table->string('homepage', 100);
            $table->string('skype', 50);
            $table->string('facebook', 50);
            $table->string('twitter', 50);

            $table->string('main_character', 20);
            $table->string('main_guild', 50);
            $table->string('favorite_race', 20);
            $table->string('favorite_class', 20);
            $table->string('favorite_spec', 20);
            $table->string('favorite_instance', 50);
            $table->string('favorite_battleground', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'alias',
                'birthday_at',
                'gender',
                'city',
                'profession',
                'hobbies',
                'homepage',
                'skype',
                'facebook',
                'twitter',
                'main_character',
                'main_guild',
                'favorite_race',
                'favorite_class',
                'favorite_spec',
                'favorite_instance',
                'favorite_battleground',
            ]);
        });
    }
}
