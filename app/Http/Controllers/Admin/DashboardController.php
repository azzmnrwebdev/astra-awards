<?php

namespace App\Http\Controllers\Admin;

use App\Models\Timeline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mosque;
use App\Models\PillarOne;
use App\Models\PillarTwo;
use App\Models\Presentation;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalPillarOne = 0;
        $totalPillarTwo = 0;
        $totalPillarThree = 0;
        $totalPillarFour = 0;
        $totalPillarFive = 0;

        $timeline = Timeline::latest()->first();
        $totalPresentation = Presentation::count();
        $totalDKM = User::with(['mosque'])->where('role', 'user')->count();
        $mosques = Mosque::with(['pillarOne', 'pillarTwo', 'pillarThree', 'pillarFour', 'pillarFive'])->get();

        foreach ($mosques as $item) {
            $totalPillarOne += $this->calculatePillarCompletion($item->pillarOne, ['question_one', 'question_two', 'question_three', 'question_four', 'question_five']);
            $totalPillarTwo += $this->calculatePillarCompletion($item->pillarTwo, ['question_one', 'question_two', 'question_three', 'question_four', 'question_five']);
            $totalPillarThree += $this->calculatePillarCompletion($item->pillarThree, ['question_one', 'question_two', 'question_three', 'question_four', 'question_five', 'question_six']);
            $totalPillarFour += $this->calculatePillarCompletion($item->pillarFour, ['question_one', 'question_two', 'question_three', 'question_four', 'question_five']);
            $totalPillarFive += $this->calculatePillarCompletion($item->pillarFive, ['question_one', 'question_two', 'question_three', 'question_four', 'question_five']);
        }

        return view('admin.pages.index', compact('totalDKM', 'totalPillarOne', 'totalPillarTwo', 'totalPillarThree', 'totalPillarFour', 'totalPillarFive', 'totalPresentation', 'timeline'));
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

    private function calculatePillarCompletion($pillar, $fields)
    {
        if (!$pillar) {
            return 0;
        }

        $completed = 0;
        $totalFields = count($fields);

        foreach ($fields as $field) {
            if (!empty($pillar->$field)) {
                $completed++;
            }
        }

        return $completed === $totalFields ? 1 : 0;
    }
}
