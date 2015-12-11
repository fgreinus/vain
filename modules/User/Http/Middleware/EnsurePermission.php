<?php

namespace Modules\User\Http\Middleware;

use Closure;

class EnsurePermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param $value
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $value)
    {
        if (\Gate::denies($value)) {
            app()->abort(403, 'Missing permission \''.$value.'\'');
        }

        return $next($request);
    }
}
