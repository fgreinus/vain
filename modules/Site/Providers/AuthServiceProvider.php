<?php

namespace Modules\Site\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Site\Entities\Page;
use Modules\Site\Policies\PagePolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Page::class => PagePolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);
    }
}
