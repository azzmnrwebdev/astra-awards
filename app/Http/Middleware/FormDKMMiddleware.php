<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Timeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FormDKMMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $timeline = Timeline::latest()->first();

        if ($user->hasRole('user')) {
            if ($timeline && $timeline->start_form && $timeline->end_form) {
                $startForm = Carbon::parse($timeline->start_form)->toDateString();
                $endForm = Carbon::parse($timeline->end_form)->toDateString();
                $currentDate = Carbon::now()->setTimezone('Asia/Jakarta')->toDateString();

                if ($currentDate < $startForm) {
                    return response()->view('pages.form.not-open');
                }

                if ($currentDate > $endForm) {
                    return response()->view('pages.form.closed');
                }
            }
        }

        return $next($request);
    }
}
