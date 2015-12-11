<?php

namespace Modules\Blog\Database\Seeders;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\CategoryContent;
use Modules\Blog\Entities\Comment;
use Modules\Blog\Entities\Post;
use Modules\Blog\Entities\PostContent;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call('Modules\Blog\Database\Seeders\CategoriesTableSeeder');
        $this->call('Modules\Blog\Database\Seeders\PostsTableSeeder');
        $this->call('Modules\Blog\Database\Seeders\CommentsTableSeeder');
        $this->call('Modules\Blog\Database\Seeders\CategoriesContentTableSeeder');
        $this->call('Modules\Blog\Database\Seeders\PostsContentTableSeeder');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('blog_categories')->delete();

        Category::create([
            'id'   => 1,
            'slug' => 'support',
        ]);

        Category::create([
            'id'   => 2,
            'slug' => 'development',
        ]);

        Category::create([
            'id'   => 3,
            'slug' => 'event',
        ]);
    }
}

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('blog_posts')->delete();

        Post::create([
            'id'          => 1,
            'user_id'     => 1,
            'slug'        => 'new-gamemaster',
            'category_id' => 1,
        ]);

        Post::create([
            'id'          => 2,
            'user_id'     => 1,
            'slug'        => 'zulaman-released',
            'category_id' => 2,
        ]);
    }
}

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('blog_comments')->delete();

        Comment::create([
            'id'       => 1,
            'user_id'  => 1,
            'post_id'  => 1,
            'text'     => 'All GMs are faggots...',
            'bluepost' => false,
        ]);

        Comment::create([
            'id'       => 2,
            'user_id'  => 1,
            'post_id'  => 2,
            'text'     => 'Yay, devs are best!',
            'bluepost' => false,
        ]);
    }
}

class CategoriesContentTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('blog_categories_content')->delete();

        CategoryContent::create([
            'id'          => 1,
            'category_id' => 1,
            'locale'      => 'en',
            'name'        => 'Support',
        ]);

        CategoryContent::create([
            'id'          => 2,
            'category_id' => 1,
            'locale'      => 'de',
            'name'        => 'Support',
        ]);

        CategoryContent::create([
            'id'          => 3,
            'category_id' => 2,
            'locale'      => 'en',
            'name'        => 'Development',
        ]);

        CategoryContent::create([
            'id'          => 4,
            'category_id' => 2,
            'locale'      => 'de',
            'name'        => 'Entwicklung',
        ]);

        CategoryContent::create([
            'id'          => 5,
            'category_id' => 3,
            'locale'      => 'en',
            'name'        => 'Events',
        ]);

        CategoryContent::create([
            'id'          => 6,
            'category_id' => 3,
            'locale'      => 'de',
            'name'        => 'Events',
        ]);
    }
}

class PostsContentTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('blog_posts_content')->delete();

        PostContent::create([
            'id'          => 1,
            'post_id'     => 1,
            'locale'      => 'en',
            'title'       => 'New Gamemaster',
            'text'        => 'Ententuempel is our new gamemaster in staff! Best wishes for him.',
            'keywords'    => 'gamemaster,ententuempel,support',
            'description' => 'New gamemaster ententuempel in staff.',
        ]);

        PostContent::create([
            'id'          => 2,
            'post_id'     => 1,
            'locale'      => 'de',
            'title'       => 'Neuer Gamemaster',
            'text'        => 'Ententuempel unterstützt ab sofort unser Support-Team! Wir wünschen ihm alles Gute.',
            'keywords'    => 'gamemaster,ententuempel,support',
            'description' => 'Ein neuer Gamemaster im Team.',
        ]);

        PostContent::create([
            'id'          => 3,
            'post_id'     => 2,
            'locale'      => 'en',
            'title'       => 'Zul\'Aman released!',
            'text'        => 'The epic troll instance is now open for every player.',
            'keywords'    => 'zulaman,troll,instance,development',
            'description' => 'Zul\'Aman has been released.',
        ]);

        PostContent::create([
            'id'          => 4,
            'post_id'     => 2,
            'locale'      => 'de',
            'title'       => 'Zul\'Aman eröffnet!',
            'text'        => 'Die epische Trollinstanz ist nun für alle Spieler zugänglich.',
            'keywords'    => 'zulaman,troll,instanz,entwicklung',
            'description' => 'Zul\'Aman wurde eröffnet.',
        ]);
    }
}
