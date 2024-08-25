<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasRoleUserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role === "user") {
            return $next($request);
        }

        abort(401);
    }
}
