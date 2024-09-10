<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Timeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SelectionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $timeline = Timeline::latest()->first();

        if ($user->hasRole('admin')) {
            if ($timeline && $timeline->start_selection && $timeline->end_selection) {
                $startSelection = Carbon::parse($timeline->start_selection)->toDateString();
                $endSelection = Carbon::parse($timeline->end_selection)->toDateString();
                $currentDate = Carbon::now()->setTimezone('Asia/Jakarta')->toDateString();

                if ($currentDate < $startSelection) {
                    return response()->view('pages.selection.not-open');
                }

                if ($currentDate > $endSelection) {
                    return response()->view('pages.selection.closed');
                }
            }
        }

        return $next($request);
    }
}
