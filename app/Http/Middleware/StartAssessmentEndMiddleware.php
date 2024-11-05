<?php

namespace App\Http\Middleware;

use App\Models\Timeline;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StartAssessmentEndMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $timeline = Timeline::latest()->first();

        if ($timeline && $timeline->end_initial_assessment) {
            $endAssessment = Carbon::parse($timeline->end_initial_assessment)->toDateString();
            $currentDate = Carbon::now()->setTimezone('Asia/Jakarta')->toDateString();

            if ($currentDate > $endAssessment) {
                return response()->view('admin.pages.assessment.start-assessment-closed');
            }
        }

        return $next($request);
    }
}
