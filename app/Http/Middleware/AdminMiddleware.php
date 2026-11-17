<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/** Super-admin-only screens (Users, Roles, API Access). Staff get a 403. */
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user && $user->isSuperAdmin() && $user->is_active) {
            return $next($request);
        }

        abort(403, 'Unauthorized Access');
    }
}
