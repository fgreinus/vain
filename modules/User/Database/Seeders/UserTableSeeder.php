<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Permission;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;

class UserTableSeeder extends Seeder
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

        DB::table('users')->delete();

        $admin = User::create([
            'id'          => 1,
            'name'        => 'admin',
            'email'       => 'admin@vain.app',
            'password'    => bcrypt('123456'),
            'locale'      => 'en',
            'birthday_at' => '2000-01-01',
        ]);

        $fgreinus = User::create([
            'id'          => 2,
            'name'        => 'fgreinus',
            'email'       => 'florian.greinus@gmail.com',
            'password'    => bcrypt('123456'),
            'locale'      => 'de',
            'birthday_at' => '2000-01-01',
        ]);

        $voydz = User::create([
            'id'          => 3,
            'name'        => 'voydz',
            'email'       => 'voydz@hotmail.com',
            'password'    => bcrypt('123456'),
            'locale'      => 'de',
            'birthday_at' => '2000-01-01',
        ]);

        $ottowayne = User::create([
            'id'          => 4,
            'name'        => 'ottowayne',
            'email'       => 'mr.ottowayne@gmail.com',
            'password'    => bcrypt('123456'),
            'locale'      => 'de',
            'birthday_at' => '2000-01-01',
        ]);

        // add user to admin roles
        /** @var Role[] $adminRoles */
        $adminRoles = Role::where('name', 'administrator')->get();
        $admin->saveRoles($adminRoles);
        $fgreinus->saveRoles($adminRoles);
        $voydz->saveRoles($adminRoles);
        $ottowayne->saveRoles($adminRoles);

        // add all permissions to admin roles
        /** @var Permission[] $permissions */
        $permissions = Permission::all();
        foreach ($adminRoles as $role) {
            $role->savePermissions($permissions);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
