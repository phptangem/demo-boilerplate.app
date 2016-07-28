<?php

namespace App\Http\Middleware;

use Closure;

class RouteNeedsRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(! access()->hasRole($role)){
            return redirect()
                ->route('frontend.index')
                ->withFlashDanger('auth.general_error');
        }

        return $next($request);
    }
}
