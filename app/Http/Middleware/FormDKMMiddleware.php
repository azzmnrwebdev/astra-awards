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
                $startForm = Carbon::parse($timeline->start_form);
                $endForm = Carbon::parse($timeline->end_form);
                $currentDate = Carbon::now();

                if ($currentDate->lt($startForm)) {
                    return response()->view('pages.form.form-not-open');
                }

                if ($currentDate->gt($endForm->endOfDay())) {
                    return response()->view('pages.form.form-closed');
                }
            }
        }

        return $next($request);
    }
}
