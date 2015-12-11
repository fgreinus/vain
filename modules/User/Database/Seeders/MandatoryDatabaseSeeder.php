<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Permission;
use Modules\User\Entities\Role;

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

        $this->call('Modules\User\Database\Seeders\PermissionPermissionTableSeeder');
        $this->call('Modules\User\Database\Seeders\RolePermissionTableSeeder');
        $this->call('Modules\User\Database\Seeders\UserPermissionTableSeeder');

        $this->call('Modules\User\Database\Seeders\RoleTableSeeder');
    }
}

class PermissionPermissionTableSeeder extends Seeder
{
    public function run()
    {
        // general admin view permission, though the user component
        // delivers permission management we seed it from here
        Permission::where('name', 'app.admin.show')->delete();
        Permission::create([
            'name'         => 'app.admin.show',
            'display_name' => 'Show admin panel',
            'description'  => 'Permission to generally view the admin control panel.',
        ]);

        Permission::where('name', 'user.permission.show')->delete();
        Permission::create([
            'name'         => 'user.permission.show',
            'display_name' => 'Show permission',
            'description'  => 'Permission to show a list of or a single permission.',
        ]);
    }
}

class RolePermissionTableSeeder extends Seeder
{
    public function run()
    {
        Permission::where('name', 'user.role.show')->delete();
        Permission::create([
            'name'         => 'user.role.show',
            'display_name' => 'Show role',
            'description'  => 'Permission to show a list of or a single role.',
        ]);

        Permission::where('name', 'user.role.create')->delete();
        Permission::create([
            'name'         => 'user.role.create',
            'display_name' => 'Create role',
            'description'  => 'Permission to create a new role.',
        ]);

        Permission::where('name', 'user.role.edit')->delete();
        Permission::create([
            'name'         => 'user.role.edit',
            'display_name' => 'Edit role',
            'description'  => 'Permission to modify an existing role.',
        ]);

        Permission::where('name', 'user.role.destroy')->delete();
        Permission::create([
            'name'         => 'user.role.destroy',
            'display_name' => 'Delete role',
            'description'  => 'Permission to delete an existing role.',
        ]);
    }
}

class UserPermissionTableSeeder extends Seeder
{
    public function run()
    {
        Permission::where('name', 'user.user.show')->delete();
        Permission::create([
            'name'         => 'user.user.show',
            'display_name' => 'Show user',
            'description'  => 'Permission to show a list of or a single user.',
        ]);

        Permission::where('name', 'user.user.create')->delete();
        Permission::create([
            'name'         => 'user.user.create',
            'display_name' => 'Create user',
            'description'  => 'Permission to create a new user.',
        ]);

        Permission::where('name', 'user.user.edit')->delete();
        Permission::create([
            'name'         => 'user.user.edit',
            'display_name' => 'Edit user',
            'description'  => 'Permission to modify an existing user.',
        ]);

        Permission::where('name', 'user.user.destroy')->delete();
        Permission::create([
            'name'         => 'user.user.destroy',
            'display_name' => 'Delete user',
            'description'  => 'Permission to delete an existing user.',
        ]);
    }
}

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->delete();
        // possibly later we'll add roles in module's seeds, so we possibly should restrict deletion here
        /*Role::whereIn('name', ['administrator', 'supporter', 'developer', 'teamleader', 'moderator', 'designer', 'vip',
            'tester', 'teammember', 'registered', 'unconfirmed'])->delete();*/

        Role::create([
            'name'         => 'administrator',
            'display_name' => 'Administrator',
            'description'  => 'User has full access to everything in the system.',
            'color'        => 'administrator',
            'order'        => 1,
        ]);

        Role::create([
            'name'         => 'supporter',
            'display_name' => 'Supporter',
            'description'  => 'User is able to manage content and community.',
            'color'        => 'supporter',
            'order'        => 30,
        ]);

        Role::create([
            'name'         => 'teammember',
            'display_name' => 'Teammember',
            'description'  => 'User is a member of the staff.',
            'color'        => 'registered',
            'order'        => 60,
        ]);

        Role::create([
            'name'         => 'teamleader',
            'display_name' => 'Teamleader',
            'description'  => 'User is team leader.',
            'color'        => 'teamleader',
            'order'        => 10,
        ]);

        Role::create([
            'name'         => 'developer',
            'display_name' => 'Developer',
            'description'  => 'User is developer.',
            'color'        => 'developer',
            'order'        => 20,
        ]);

        Role::create([
            'name'         => 'tester',
            'display_name' => 'Tester',
            'description'  => 'User is tester.',
            'color'        => 'tester',
            'order'        => 40,
        ]);

        Role::create([
            'name'         => 'moderator',
            'display_name' => 'Moderator',
            'description'  => 'User is moderator.',
            'color'        => 'moderator',
            'order'        => 100,
        ]);

        Role::create([
            'name'         => 'designer',
            'display_name' => 'Designer',
            'description'  => 'User is designer.',
            'color'        => 'designer',
            'order'        => 70,
        ]);

        Role::create([
            'name'         => 'vip',
            'display_name' => 'VIP',
            'description'  => 'User is VIP.',
            'color'        => 'vip',
            'order'        => 90,
        ]);

        Role::create([
            'name'         => 'registered',
            'display_name' => 'Registered',
            'description'  => 'A registered member of the community.',
            'color'        => 'registered',
            'order'        => 200,
        ]);

        Role::create([
            'name'         => 'unconfirmed',
            'display_name' => 'Unconfirmed',
            'description'  => 'User has registered but did not finish the process yet.',
            'color'        => 'registered',
            'order'        => 255,
        ]);
    }
}
