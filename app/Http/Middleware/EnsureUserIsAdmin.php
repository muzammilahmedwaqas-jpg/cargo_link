<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Runs before every admin route. The 'auth' middleware has already
     * made sure someone is logged in; this one makes sure they are an admin.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->is_admin) {
            abort(403, 'Admins only.');
        }

        return $next($request);
    }
}
