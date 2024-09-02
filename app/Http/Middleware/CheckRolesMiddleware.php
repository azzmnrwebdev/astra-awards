<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRolesMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if ($user && $user->hasAnyRole($roles) && $user->status === 1) {
            return $next($request);
        }

        abort(403, 'Unauthorized Action.');
    }
}
