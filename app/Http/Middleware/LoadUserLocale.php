<?php

namespace Vain\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class LoadUserLocale
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
        if (!Auth::guest()) {
            // if the user is logged in we can set the prefered locale
            App::setLocale(Auth::user()->locale);
        }

        // otherwise we have to determine the current location or just keep fallback locale?

        return $next($request);
    }
}
