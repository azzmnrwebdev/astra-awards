<?php

namespace App\Http\Middleware;

use App\Models\Timeline;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class InitialAssessmentMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $timeline = Timeline::latest()->first();

        if ($user->hasRole('jury')) {
            if ($timeline && $timeline->start_initial_assessment && $timeline->end_initial_assessment) {
                $startAssessment = Carbon::parse($timeline->start_initial_assessment)->toDateString();
                $endAssessment = Carbon::parse($timeline->end_initial_assessment)->toDateString();
                $currentDate = Carbon::now()->setTimezone('Asia/Jakarta')->toDateString();

                if ($currentDate < $startAssessment) {
                    return response()->view('pages.presentation.not-open');
                }

                if ($currentDate > $endAssessment) {
                    return response()->view('pages.presentation.closed');
                }
            }
        }

        return $next($request);
    }
}
