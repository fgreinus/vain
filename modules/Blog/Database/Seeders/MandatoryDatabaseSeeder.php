<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\User\Entities\Permission;

class MandatoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('Modules\Blog\Database\Seeders\PostPermissionTableSeeder');
        $this->call('Modules\Blog\Database\Seeders\CommentPermissionTableSeeder');
        $this->call('Modules\Blog\Database\Seeders\CategoryPermissionTableSeeder');
    }
}

class PostPermissionTableSeeder extends Seeder
{
    public function run()
    {
        Permission::where('name', 'LIKE', 'blog.post.%')->delete();

        Permission::create([
            'name'         => 'blog.post.show',
            'display_name' => 'Show blog post',
            'description'  => 'Permission to show a list of or a single post.',
        ]);

        Permission::create([
            'name'         => 'blog.post.create',
            'display_name' => 'Create blog post',
            'description'  => 'Permission to create a new post.',
        ]);

        Permission::create([
            'name'         => 'blog.post.edit',
            'display_name' => 'Edit blog post',
            'description'  => 'Permission to modify an existing post.',
        ]);

        Permission::create([
            'name'         => 'blog.post.destroy',
            'display_name' => 'Delete blog post',
            'description'  => 'Permission to delete an existing post.',
        ]);
    }
}

class CommentPermissionTableSeeder extends Seeder
{
    public function run()
    {
        Permission::where('name', 'LIKE', 'blog.comment.%')->delete();

        Permission::create([
            'name'         => 'blog.comment.show',
            'display_name' => 'Show blog comment',
            'description'  => 'Permission to show a list of or a single comment.',
        ]);

        Permission::create([
            'name'         => 'blog.comment.create',
            'display_name' => 'Create blog comment',
            'description'  => 'Permission to create a new comment.',
        ]);

        Permission::create([
            'name'         => 'blog.comment.edit',
            'display_name' => 'Edit blog comment',
            'description'  => 'Permission to modify an existing comment.',
        ]);

        Permission::create([
            'name'         => 'blog.comment.destroy',
            'display_name' => 'Delete blog comment',
            'description'  => 'Permission to delete an existing comment.',
        ]);

        Permission::create([
            'name'         => 'blog.comment.bluepost',
            'display_name' => 'Posts comments as bluepost',
            'description'  => 'All comments from this user are blueposts',
        ]);
    }
}

class CategoryPermissionTableSeeder extends Seeder
{
    public function run()
    {
        Permission::where('name', 'LIKE', 'blog.category.%')->delete();

        Permission::create([
            'name'         => 'blog.category.show',
            'display_name' => 'Show blog category',
            'description'  => 'Permission to show a list of or a single category.',
        ]);

        Permission::create([
            'name'         => 'blog.category.create',
            'display_name' => 'Create blog category',
            'description'  => 'Permission to create a new category.',
        ]);

        Permission::create([
            'name'         => 'blog.category.edit',
            'display_name' => 'Edit blog category',
            'description'  => 'Permission to modify an existing category.',
        ]);

        Permission::create([
            'name'         => 'blog.category.destroy',
            'display_name' => 'Delete blog category',
            'description'  => 'Permission to delete an existing category.',
        ]);
    }
}
