<?php

namespace App\Http\Controllers;

use App\Models\SystemAssessment;
use Illuminate\Http\Request;

class SystemAssessmentController extends Controller
{
    public function pillarOneAct(Request $request)
    {
        $nilaiMappingRadio = [
            1 => 1,
            2 => 3,
            3 => 7,
            4 => 9,
        ];

        $data = [
            'pillar_one_question_one' => $nilaiMappingRadio[$request->input('pillar_one_question_one')] ?? null,
            'pillar_one_question_two' => $nilaiMappingRadio[$request->input('pillar_one_question_two')] ?? null,
            'pillar_one_question_three' => $nilaiMappingRadio[$request->input('pillar_one_question_three')] ?? null,
            'pillar_one_question_four' => $nilaiMappingRadio[$request->input('pillar_one_question_four')] ?? null,
            'pillar_one_question_five' => $nilaiMappingRadio[$request->input('pillar_one_question_five')] ?? null,
        ];

        SystemAssessment::updateOrCreate(
            ['pillar_one_id' => $request->input('pillar_one_id')],
            $data
        );

        return redirect()->back()->with('success_assessment', 'Nilai berhasil ditampilkan');
    }

    public function pillarTwoAct(Request $request)
    {
        $nilaiMappingRadio = [
            1 => 1,
            2 => 3,
            3 => 7,
            4 => 9,
        ];

        $nilaiMappingCheckbox = [
            '' => 1,
            '1' => 7,
            '2' => 7,
            '3' => 3,
            '1,3' => 7,
            '2,3' => 7,
            '1,2' => 9,
            '1,2,3' => 9,
        ];

        $questionTwo = $request->input('pillar_two_question_two', []);
        sort($questionTwo);
        $questionTwoKey = implode(',', $questionTwo);
        $resultQuestionTwo = $nilaiMappingCheckbox[$questionTwoKey] ?? 1;

        $questionThree = $request->input('pillar_two_question_three', []);
        sort($questionThree);
        $questionThreeKey = implode(',', $questionThree);
        $resultQuestionThree = $nilaiMappingCheckbox[$questionThreeKey] ?? 1;

        $questionFour = $request->input('pillar_two_question_four', []);
        sort($questionFour);
        $questionFourKey = implode(',', $questionFour);
        $resultQuestionFour = $nilaiMappingCheckbox[$questionFourKey] ?? 1;

        $data = [
            'pillar_two_question_one' => $nilaiMappingRadio[$request->input('pillar_two_question_one')] ?? null,
            'pillar_two_question_two' => $resultQuestionTwo,
            'pillar_two_question_three' => $resultQuestionThree,
            'pillar_two_question_four' => $resultQuestionFour,
        ];

        SystemAssessment::updateOrCreate(
            ['pillar_two_id' => $request->input('pillar_two_id')],
            $data
        );

        return redirect()->back()->with('success_assessment', 'Nilai berhasil ditampilkan');
    }

    public function pillarThreeAct(Request $request)
    {
        //
    }

    public function pillarFourAct(Request $request)
    {
        //
    }

    public function pillarFiveAct(Request $request)
    {
        //
    }
}
