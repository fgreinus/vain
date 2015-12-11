<?php

namespace Modules\Site\Database\Seeders;

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

        $this->call('Modules\Site\Database\Seeders\PermissionTableSeeder');
    }
}

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        Permission::where('name', 'site.page.show')->delete();
        Permission::create([
            'name'         => 'site.page.show',
            'display_name' => 'Show page',
            'description'  => 'Permission to show a list of or a single page.',
        ]);

        Permission::where('name', 'site.page.create')->delete();
        Permission::create([
            'name'         => 'site.page.create',
            'display_name' => 'Create page',
            'description'  => 'Permission to create a new page.',
        ]);

        Permission::where('name', 'site.page.edit')->delete();
        Permission::create([
            'name'         => 'site.page.edit',
            'display_name' => 'Edit page',
            'description'  => 'Permission to modify an existing page.',
        ]);

        Permission::where('name', 'site.page.destroy')->delete();
        Permission::create([
            'name'         => 'site.page.destroy',
            'display_name' => 'Delete page',
            'description'  => 'Permission to delete an existing page.',
        ]);
    }
}
