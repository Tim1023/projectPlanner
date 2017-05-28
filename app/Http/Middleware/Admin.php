<?php

namespace ProgramPlanner\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->hasAdminAccess()) {
            return $next($request);
        } else {
            if ($request->ajax()) {
                return response('Unauthorized!', 403);
            } else {
                return redirect()->guest('/')->with("errorResponse", "Access Forbidden!");
            }
        }
    }
}
