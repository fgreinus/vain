<?php namespace Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Laracasts\Integrated\Extensions\Laravel as IntegrationTest;

class TestCase extends IntegrationTest {

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

    public function setUp()
    {
        parent::setUp();

        Artisan::call('module:migrate');
//        Artisan::call('db:seed');
//
//        Artisan::call('module:seed', ['module' => 'user']);
//        Artisan::call('module:seed', ['module' => 'site']);
//        Artisan::call('module:seed', ['module' => 'blog']);

        // required for csrf middleware
        Session::start();
    }

}
