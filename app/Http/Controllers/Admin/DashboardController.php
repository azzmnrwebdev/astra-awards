<?php

namespace App\Http\Controllers\Admin;

use App\Models\Timeline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BusinessLine;
use App\Models\CategoryArea;
use App\Models\CategoryMosque;
use App\Models\Company;
use App\Models\Mosque;
use App\Models\Province;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalCompany = Company::count();
        $totalProvince = Province::count();
        $timeline = Timeline::latest()->first();
        $totalBusinessLine = BusinessLine::count();
        $totalDKM = User::with(['mosque'])->where('role', 'user')->count();

        $provinces = Province::all();
        $businessLines = BusinessLine::all();
        $categoryAreas = CategoryArea::all();
        $categoryMosques = CategoryMosque::all();

        $mosqueCounts = [];
        foreach ($categoryAreas as $area) {
            foreach ($categoryMosques as $mosque) {
                $count = Mosque::where('category_area_id', $area->id)
                    ->where('category_mosque_id', $mosque->id)
                    ->count();
                $mosqueCounts[$area->id][$mosque->id] = $count;
            }
        }

        foreach ($provinces as $province) {
            $province->mosque_count = $province->city->sum(function ($city) {
                return $city->mosque ? $city->mosque->count() : 0;
            });
        }

        foreach ($businessLines as $businessLine) {
            $businessLine->mosque_count = $businessLine->company->sum(function ($company) {
                return $company->mosque ? $company->mosque->count() : 0;
            });
        }

        return view('admin.pages.index', compact(
            'totalCompany',
            'totalProvince',
            'timeline',
            'totalBusinessLine',
            'totalDKM',
            'categoryMosques',
            'categoryAreas',
            'businessLines',
            'provinces',
            'mosqueCounts',
        ));
    }

    public function dashboardAct(Request $request)
    {
        $rules = [
            'registration' => 'required',
            'form_filling' => 'required',
            'selection' => 'required',
            'initial_assessment' => 'required',
            'final_assessment' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $startRegistration = $request->input('start_registration');
        $endRegistration = $request->input('end_registration');
        $startForm = $request->input('start_form');
        $endForm = $request->input('end_form');
        $startSelection = $request->input('start_selection');
        $endSelection = $request->input('end_selection');
        $startInitialAssessment = $request->input('start_initial_assessment');
        $endInitialAssessment = $request->input('end_initial_assessment');
        $startFinalAssessment = $request->input('start_final_assessment');
        $endFinalAssessment = $request->input('end_final_assessment');

        Timeline::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'start_registration' => $startRegistration,
                'end_registration' => $endRegistration,
                'start_form' => $startForm,
                'end_form' => $endForm,
                'start_selection' => $startSelection,
                'end_selection' => $endSelection,
                'start_initial_assessment' => $startInitialAssessment,
                'end_initial_assessment' => $endInitialAssessment,
                'start_final_assessment' => $startFinalAssessment,
                'end_final_assessment' => $endFinalAssessment,
            ]
        );

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}
