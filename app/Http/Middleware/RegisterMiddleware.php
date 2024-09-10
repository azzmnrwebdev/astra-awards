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
            $startRegistration = Carbon::parse($timeline->start_registration)->toDateString();
            $endRegistration = Carbon::parse($timeline->end_registration)->toDateString();
            $currentDate = Carbon::now()->setTimezone('Asia/Jakarta')->toDateString();

            if ($currentDate < $startRegistration) {
                return response()->view('auth.registration-not-open');
            }

            if ($currentDate > $endRegistration) {
                return response()->view('auth.registration-closed');
            }
        } else {
            return response()->view('auth.registration-not-open');
        }

        return $next($request);
    }
}
