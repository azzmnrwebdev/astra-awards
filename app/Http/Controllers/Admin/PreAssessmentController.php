<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PreAssessmentController extends Controller
{
    public function index()
    {
        return view('admin.pages.assessment.pre-assessment');
    }
}
