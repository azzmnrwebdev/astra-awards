<?php

namespace App\Http\Middleware;

use App\Models\Timeline;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EndAssessmentEndMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $timeline = Timeline::latest()->first();

        if ($timeline && $timeline->end_final_assessment) {
            $endAssessment = Carbon::parse($timeline->end_final_assessment)->toDateString();
            $currentDate = Carbon::now()->setTimezone('Asia/Jakarta')->toDateString();

            if ($currentDate > $endAssessment) {
                return response()->view('admin.pages.assessment.end-assessment-closed');
            }
        }

        return $next($request);
    }
}
