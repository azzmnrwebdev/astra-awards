<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Timeline;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $timeline = Timeline::latest()->first();

        if ($timeline && $timeline->start_registration && $timeline->end_registration) {
            $startRegistration = Carbon::parse($timeline->start_registration);
            $endRegistration = Carbon::parse($timeline->end_registration);
            $currentDate = Carbon::now();

            if ($currentDate->lt($startRegistration)) {
                return response()->view('auth.registration-not-open');
            }

            if ($currentDate->gt($endRegistration->endOfDay())) {
                return response()->view('auth.registration-closed');
            }
        }

        return $next($request);
    }
}
