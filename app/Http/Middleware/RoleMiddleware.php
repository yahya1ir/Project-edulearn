<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles  (one or more roles allowed)
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check user log
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Check role
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}