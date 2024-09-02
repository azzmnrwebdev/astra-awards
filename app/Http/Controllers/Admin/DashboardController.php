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
            'start_registration' => 'date',
            'end_registration' => 'nullable|date|after_or_equal:start_registration',
            'start_selection' => 'date',
            'end_selection' => 'nullable|date|after_or_equal:start_selection',
            'start_initial_assessment' => 'date',
            'end_initial_assessment' => 'nullable|date|after_or_equal:start_initial_assessment',
            'start_final_assessment' => 'date',
            'end_final_assessment' => 'nullable|date|after_or_equal:start_final_assessment',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Timeline::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'start_registration' => $request->input('start_registration'),
                'end_registration' => $request->input('end_registration'),
                'start_selection' => $request->input('start_selection'),
                'end_selection' => $request->input('end_selection'),
                'start_initial_assessment' => $request->input('start_initial_assessment'),
                'end_initial_assessment' => $request->input('end_initial_assessment'),
                'start_final_assessment' => $request->input('start_final_assessment'),
                'end_final_assessment' => $request->input('end_final_assessment'),
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
