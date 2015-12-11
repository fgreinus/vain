<?php

namespace Modules\User\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class TrackUserActivity
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param callable|Closure         $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check()) {
            /** @var \Modules\User\Entities\User $user */
            $user = $this->auth->user();

            $user->last_active_at = $user->freshTimestamp();
            $user->saveWithoutTimestamps(); // don't update updated_at
        }

        return $next($request);
    }
}
