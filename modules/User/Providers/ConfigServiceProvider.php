<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Overwrite any vendor / package configuration.
     *
     * This service provider is intended to provide a convenient location for you
     * to overwrite any "vendor" or package configuration that you may want to
     * modify before the application handles the incoming request / command.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Config/auth.php', 'auth'
        );

        $this->mergeConfigFrom(
            __DIR__.'/../Config/services.php', 'services'
        );

        $this->mergeConfigFrom(
            __DIR__.'/../Config/access.php', 'access'
        );

        $this->mergeConfigFrom(
            __DIR__.'/../Config/roles.php', 'roles'
        );
    }

    /**
     * we just prioritize our service provider over the config from
     * other packages.
     *
     * @param string $path
     * @param string $key
     */
    protected function mergeConfigFrom($path, $key)
    {
        $config = $this->app['config']->get($key, []);

        $this->app['config']->set($key, array_merge($config, require $path));
    }
}
