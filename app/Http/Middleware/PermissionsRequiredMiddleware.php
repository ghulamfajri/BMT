<?php

namespace App\Http\Middleware;

use Closure;

class PermissionsRequiredMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $tipe)
    {
        if ($request->user()->tipe != $tipe) {
            // If we reach this far, the user does not have the required permissions.
//            return abort(401);
//            return abort(401, "the user does not have the required permissions");
            return redirect('/');
        } else
            return $next($request);
    }
}
