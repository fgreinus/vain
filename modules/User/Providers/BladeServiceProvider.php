<?php

namespace Modules\User\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::directive('userbadge', function ($expression) {

            return "<span class=\"label label-role role-<?php echo with{$expression}->roles()->count() > 0 ? with{$expression}->roles()->ordered()->first()->color : ''; ?>\"><?php echo with{$expression}->name; ?></span>";
        });
    }

    public function register()
    {
        //
    }
}
