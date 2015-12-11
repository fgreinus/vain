<?php

namespace Vain\Providers;

use Dowilcox\KnpMenu\Facades\Menu;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Vain\Events\BackendMenuCreated;
use Vain\Events\FrontendMenuCreated;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register any application menu.
     *
     * All menues should be registered here and if it makes sense they could be binded
     * to their corresponding views directly
     *
     * @return void
     */
    public function register()
    {
        $this->registerFrontendMenu();

        $this->registerBackendMenu();
    }

    /**
     * build frontend menu and attach it to view.
     */
    private function registerFrontendMenu()
    {
        $this->app->singleton('menu.frontend', function () {
            return Menu::create('frontend');
        });

        View::composer('app', function ($view) {
            $handler = app('menu.frontend');
            $view->with('menu', $handler);

            // inject home item
            $handler->addChild('Home')
                ->setUri(route('index.home'))
                ->setExtra('icon', 'home');

            if (Gate::allows('app.admin.show')) {
                $handler->addChild('Admin Panel')
                    ->setUri(route('user.admin.users.index'))
                    ->setExtra('icon', 'tachometer');
            }

            Event::fire(new FrontendMenuCreated($handler, $view));
        });
    }

    /*
 * build backend menu and attach it to view
 */

    private function registerBackendMenu()
    {
        $this->app->singleton('menu.backend', function () {
            return Menu::create('backend');
        });

        View::composer('admin', function ($view) {
            $handler = app('menu.backend');
            $view->with('menu', $handler);

            $handler->addChild('admin.menu')
                ->setAttribute('class', 'header');

            Event::fire(new BackendMenuCreated($handler, $view));
        });
    }
}
