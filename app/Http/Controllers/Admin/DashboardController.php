<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Mosque;
use App\Models\Company;
use App\Models\Province;
use App\Models\Timeline;
use App\Models\BusinessLine;
use App\Models\CategoryArea;
use Illuminate\Http\Request;
use App\Models\CategoryMosque;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $arrCompany = Company::select('companies.id')->join('mosques', 'companies.id', '=', 'mosques.company_id')->groupBy('companies.id')->get();
        $totalCompany = $arrCompany->count();
        $arrProvince = Province::select('provinces.id')->join('cities', 'provinces.id', '=', 'cities.province_id')->join('mosques', 'cities.id', '=', 'mosques.city_id')->groupBy('provinces.id')->get();
        $totalProvince = $arrProvince->count();
        $timeline = Timeline::latest()->first();
        $arrBusinessLine = BusinessLine::select('business_lines.id')->join('companies', 'business_lines.id', '=', 'companies.business_line_id')->join('mosques', 'companies.id', '=', 'mosques.company_id')->groupBy('business_lines.id')->get();
        $totalBusinessLine = $arrBusinessLine->count();
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

        $text1 = date_format(date_create($startRegistration), 'd F') . '-' . date_format(date_create($endRegistration), 'd F o');
        $text2 = date_format(date_create($startForm), 'd F') . '-' . date_format(date_create($endForm), 'd F o');
        $text3 = date_format(date_create($startSelection), 'd F') . '-' . date_format(date_create($endFinalAssessment), 'd F o');

        $this->createImage($text1, $text2, $text3);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    private function createImage($text1, $text2, $text3)
    {

        $image = imagecreatefrompng(public_path('images/timeline/timeline-ori.png'));

        $textColor = imagecolorallocate($image, 0, 0, 0);

        $fontSize = 55;
        $fontPath = public_path('images/timeline/summer.otf');

        $arrText = [
            [
                'x' => 400,
                'y' => 125,
                'text' => date_format(date_create('2024-09-06'), 'd F o'),
            ],
            [
                'x' => 810,
                'y' => 320,
                'text' => $text1,
            ],
            [
                'x' => 1400,
                'y' => 125,
                'text' => $text2,
            ],
            [
                'x' => 1900,
                'y' => 410,
                'text' => $text3,
            ],
            [
                'x' => 2570,
                'y' => 620,
                'text' => date_format(date_create('2025-01-01'), 'F o'),
            ],
        ];

        foreach ($arrText as $item) {
            imagettftext($image, $fontSize, 0, $item['x'], $item['y'], $textColor, $fontPath, $item['text']);
        };

        imagepng($image, public_path('images/timeline/timeline.png'));
        imagedestroy($image);
    }
}
