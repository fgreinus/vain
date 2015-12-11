<?php

namespace Modules\User\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Log;
use Modules\User\Entities\Permission;
use PDOException;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

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

//        $gate->before(function ($user, $ability) {
//            if ($user->isSuperAdmin()) {
//                return true;
//            }
//        });

        foreach ($this->getPermission() as $permission) {
            $gate->define($permission->name, function ($user) use ($permission) {
                return $user->hasRole($permission->roles);
            });
        }
    }

    /**
     * Returns an empty error in case of non-existend database (i.e. when working with a newly deployed system).
     *
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     */
    protected function getPermission()
    {
        try {
            return Permission::with('roles')->get();
        } catch (PDOException $e) {
            Log::warning('Permission table could not be found when trying to load permissions in AuthServiceProvider');

            return [];
        }
    }
}
