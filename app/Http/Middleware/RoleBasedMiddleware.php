<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleBasedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isAdmin($request) === false)
        {
            abort(403);
        }

        return $next($request);
    }
    private function isAdmin(Request $request): bool
    {
        return $request->user() && $request->user()->role === 'Admin';
    }
}
