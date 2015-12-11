<?php

namespace Modules\Support\Database\Seeders;

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

        $this->call('Modules\Support\Database\Seeders\ArticlePermissionTableSeeder');
        $this->call('Modules\Support\Database\Seeders\CategoryPermissionTableSeeder');
    }
}

class ArticlePermissionTableSeeder extends Seeder
{
    public function run()
    {
        Permission::where('name', 'LIKE', 'support.article.%')->delete();

        Permission::create([
            'name'         => 'support.article.show',
            'display_name' => 'Show support article',
            'description'  => 'Permission to show a list of or a single support article.',
        ]);

        Permission::create([
            'name'         => 'support.article.create',
            'display_name' => 'Create support article',
            'description'  => 'Permission to create a new support article.',
        ]);

        Permission::create([
            'name'         => 'support.article.edit',
            'display_name' => 'Edit support article',
            'description'  => 'Permission to modify an existing article.',
        ]);

        Permission::create([
            'name'         => 'support.article.destroy',
            'display_name' => 'Delete support article',
            'description'  => 'Permission to delete an existing article.',
        ]);
    }
}

class CategoryPermissionTableSeeder extends Seeder
{
    public function run()
    {
        Permission::where('name', 'LIKE', 'support.category.%')->delete();

        Permission::create([
            'name'         => 'support.category.show',
            'display_name' => 'Show support category',
            'description'  => 'Permission to show a list of or a single category.',
        ]);

        Permission::create([
            'name'         => 'support.category.create',
            'display_name' => 'Create support category',
            'description'  => 'Permission to create a new category.',
        ]);

        Permission::create([
            'name'         => 'support.category.edit',
            'display_name' => 'Edit support category',
            'description'  => 'Permission to modify an existing category.',
        ]);

        Permission::create([
            'name'         => 'support.category.destroy',
            'display_name' => 'Delete support category',
            'description'  => 'Permission to delete an existing category.',
        ]);
    }
}
