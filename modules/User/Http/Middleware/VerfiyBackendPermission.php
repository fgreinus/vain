<?php

namespace Modules\User\Http\Middleware;

use Closure;

class VerfiyBackendPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Gate::denies('app.admin.show')) {
            if ($request->ajax()) {
                return response('Forbidden.', 403);
            } else {
                return app()->abort(403, 'No permission to view backend');
            }
        }

        return $next($request);
    }
}
