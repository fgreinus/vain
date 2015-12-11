<?php

namespace Vain\Packages\RealmAPI\Providers;

use Illuminate\Support\ServiceProvider;

class RealmApiServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $langPath = __DIR__.'/../Resources/lang';
        $this->loadTranslationsFrom($langPath, 'realmapi');

        $viewPath = __DIR__.'/../Resources/views';
        $this->loadViewsFrom($viewPath, 'realmapi');

        $this->mergeConfigFrom(
            __DIR__.'/../Config/realm.php', 'realm'
        );

        $this->publishes([
            // maybe also publish assets, langs, views?
            __DIR__.'/../Config/realm.php' => config_path('realm.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Vain\Packages\RealmAPI\EmulatorFactory');
        $this->app->bind('Vain\Packages\RealmAPI\Services\SoapService');
    }
}
