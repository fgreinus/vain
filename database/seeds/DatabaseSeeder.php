<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // register your mandatory module seeders here
        $this->call('Modules\User\Database\Seeders\MandatoryDatabaseSeeder');
        $this->call('Modules\Site\Database\Seeders\MandatoryDatabaseSeeder');
        $this->call('Modules\Blog\Database\Seeders\MandatoryDatabaseSeeder');
        $this->call('Modules\Support\Database\Seeders\MandatoryDatabaseSeeder');
    }
}
