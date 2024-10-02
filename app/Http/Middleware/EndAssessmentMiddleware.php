<?php

namespace App\Http\Middleware;

use App\Models\Timeline;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EndAssessmentMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $timeline = Timeline::latest()->first();

        if ($timeline && $timeline->start_final_assessment && $timeline->end_final_assessment) {
            $startAssessment = Carbon::parse($timeline->start_final_assessment)->toDateString();
            $endAssessment = Carbon::parse($timeline->end_final_assessment)->toDateString();
            $currentDate = Carbon::now()->setTimezone('Asia/Jakarta')->toDateString();

            if ($currentDate < $startAssessment) {
                return response()->view('admin.pages.assessment.end-assessment-not-open');
            }

            if ($currentDate > $endAssessment) {
                return response()->view('admin.pages.assessment.end-assessment-closed');
            }
        }

        return $next($request);
    }
}
