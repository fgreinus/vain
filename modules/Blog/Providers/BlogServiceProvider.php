<?php

namespace Modules\Blog\Providers;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    public function boot()
    {
        $langPath = __DIR__.'/../Resources/lang';
        $this->loadTranslationsFrom($langPath, 'blog');

        $viewPath = __DIR__.'/../Resources/views';
        $this->loadViewsFrom($viewPath, 'blog');
    }
}
