<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EndAssessmentController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.pages.assessment.end-assessment');
    }
}
