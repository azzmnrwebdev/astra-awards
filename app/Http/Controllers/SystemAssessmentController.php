<?php

namespace App\Http\Controllers;

use App\Models\SystemAssessment;
use Illuminate\Http\Request;

class SystemAssessmentController extends Controller
{
    public function pillarOneAct(Request $request)
    {
        $year = date('Y');

        $nilaiMappingRadio4 = [
            1 => 1,
            2 => 3,
            3 => 7,
            4 => 9,
        ];

        $data = [
            'pillar_one_id' => $request->input('pillar_one_id'),
            'pillar_one_question_one' => $nilaiMappingRadio4[$request->input('pillar_one_question_one')] ?? null,
            'pillar_one_question_two' => $nilaiMappingRadio4[$request->input('pillar_one_question_two')] ?? null,
            'pillar_one_question_three' => $nilaiMappingRadio4[$request->input('pillar_one_question_three')] ?? null,
            'pillar_one_question_four' => $nilaiMappingRadio4[$request->input('pillar_one_question_four')] ?? null,
            'pillar_one_question_five' => $nilaiMappingRadio4[$request->input('pillar_one_question_five')] ?? null,
            'year' => $year
        ];

        SystemAssessment::updateOrCreate(
            ['id' => $request->input('id')],
            $data
        );

        return redirect()->back()->with('success', 'Nilai berhasil ditampilkan');
    }

    public function pillarTwoAct(Request $request)
    {
        $year = date('Y');

        $nilaiMappingCheckbox4 = [
            '1,2,3' => 9,
            '1,2,4' => 9,
            '1,3,4' => 9,
            '2,3,4' => 9,
            '' => 1,
            '1,2' => 9,
            '1,3' => 7,
            '2,3' => 7,
            '3' => 3,
            '1' => 7,
            '2' => 7,
        ];

        $nilaiMappingCheckbox2 = [
            '' => 1,
            '1' => 7,
            '2' => 7,
            '1,2' => 9,
        ];

        $nilaiMappingPertanyaan3 = [
            '' => 1,
            '1' => 7,
            '2' => 7,
            '3' => 7,
            '4' => 3,
            '1,2' => 9,
            '1,3' => 9,
            '1,4' => 9,
            '2,3' => 9,
            '2,4' => 9,
            '3,4' => 9,
        ];

        $questionTwo = $request->input('pillar_two_question_two', []);
        sort($questionTwo);
        $questionTwoKey = implode(',', $questionTwo);
        $resultQuestionTwo = $nilaiMappingCheckbox4[$questionTwoKey] ?? null;

        $questionThree = $request->input('pillar_two_question_three', []);
        sort($questionThree);
        $questionThreeKey = implode(',', $questionThree);
        $resultQuestionThree = $nilaiMappingCheckbox4[$questionThreeKey] ?? null;

        $questionFour = $request->input('pillar_two_question_four', []);
        sort($questionFour);
        $questionFourKey = implode(',', $questionFour);
        $resultQuestionFour = $nilaiMappingPertanyaan3[$questionFourKey] ?? null;

        $questionFive = $request->input('pillar_two_question_five', []);
        sort($questionFive);
        $questionFiveKey = implode(',', $questionFive);
        $resultquestionFive = $nilaiMappingCheckbox2[$questionFiveKey] ?? null;

        $data = [
            'pillar_two_id' => $request->input('pillar_two_id'),
            'pillar_two_question_two' => $resultQuestionTwo,
            'pillar_two_question_three' => $resultQuestionThree,
            'pillar_two_question_four' => $resultQuestionFour,
            'pillar_two_question_five' => $resultquestionFive,
            'year' => $year
        ];

        SystemAssessment::updateOrCreate(
            ['id' => $request->input('id')],
            $data
        );

        return redirect()->back()->with('success', 'Nilai berhasil ditampilkan');
    }

    public function pillarThreeAct(Request $request)
    {
        $year = date('Y');

        $nilaiMappingRadio3 = [
            1 => 1,
            2 => 7,
            3 => 9,
        ];

        $nilaiMappingRadio4 = [
            1 => 1,
            2 => 3,
            3 => 7,
            4 => 9,
        ];

        $nilaiMappingCheckbox4 = [
            '' => 1,
            '1' => 3,
            '2' => 3,
            '3' => 3,
            '4' => 3,
            '1,2' => 7,
            '1,3' => 7,
            '1,4' => 7,
            '2,3' => 7,
            '2,4' => 7,
            '3,4' => 7,
            '1,2,3' => 9,
            '1,2,4' => 9,
            '1,3,4' => 9,
            '2,3,4' => 9,
        ];

        $questionFourAmount = 0;
        $questionFour = $request->input('pillar_three_question_four', []);

        if (!empty($questionFour) && $questionFour[0] !== null) {
            $selectedOptions = explode(',', $questionFour[0]);
            $questionFourAmount = count($selectedOptions);
        }

        if ($questionFourAmount >= 1 && $questionFourAmount <= 2) {
            $resultQuestionFour = 3;
        } elseif ($questionFourAmount >= 3 && $questionFourAmount <= 4) {
            $resultQuestionFour = 7;
        } elseif ($questionFourAmount >= 5 && $questionFourAmount <= 6) {
            $resultQuestionFour = 9;
        } else {
            $resultQuestionFour = 1;
        }

        $questionSix = $request->input('pillar_three_question_six', []);
        sort($questionSix);
        $questionSixKey = implode(',', $questionSix);
        $resultQuestionSix = $nilaiMappingCheckbox4[$questionSixKey] ?? null;

        $data = [
            'pillar_three_id' => $request->input('pillar_three_id'),
            'pillar_three_question_one' => $nilaiMappingRadio4[$request->input('pillar_three_question_one')] ?? null,
            'pillar_three_question_two' => $nilaiMappingRadio3[$request->input('pillar_three_question_two')] ?? null,
            'pillar_three_question_three' => $nilaiMappingRadio4[$request->input('pillar_three_question_three')] ?? null,
            'pillar_three_question_four' => $resultQuestionFour,
            'pillar_three_question_five' => $request->input('pillar_three_question_five'),
            'pillar_three_question_six' => $resultQuestionSix,
            'year' => $year
        ];

        SystemAssessment::updateOrCreate(
            ['id' => $request->input('id')],
            $data
        );

        return redirect()->back()->with('success', 'Nilai berhasil ditampilkan');
    }

    public function pillarFourAct(Request $request)
    {
        $year = date('Y');

        $nilaiMappingRadio2 = [
            1 => 1,
            2 => 9
        ];

        $nilaiMappingRadio4 = [
            1 => 1,
            2 => 3,
            3 => 7,
            4 => 9,
        ];

        $data = [
            'pillar_four_id' => $request->input('pillar_four_id'),
            'pillar_four_question_one' => $nilaiMappingRadio2[$request->input('pillar_four_question_one')] ?? null,
            'pillar_four_question_four' => $nilaiMappingRadio4[$request->input('pillar_four_question_four')] ?? null,
            'pillar_four_question_two' => $nilaiMappingRadio2[$request->input('pillar_four_question_two')] ?? null,
            'pillar_four_question_three' => $nilaiMappingRadio4[$request->input('pillar_four_question_three')] ?? null,
            'pillar_four_question_five' => $nilaiMappingRadio2[$request->input('pillar_four_question_five')] ?? null,
            'year' => $year
        ];

        SystemAssessment::updateOrCreate(
            ['id' => $request->input('id')],
            $data
        );

        return redirect()->back()->with('success', 'Nilai berhasil ditampilkan');
    }

    public function pillarFiveAct(Request $request)
    {
        $year = date('Y');

        $nilaiMappingRadio2 = [
            1 => 1,
            2 => 9
        ];

        $nilaiMappingRadio4 = [
            1 => 1,
            2 => 3,
            3 => 7,
            4 => 9,
        ];

        $data = [
            'pillar_five_id' => $request->input('pillar_five_id'),
            'pillar_five_question_one' => $nilaiMappingRadio4[$request->input('pillar_five_question_one')] ?? null,
            'pillar_five_question_two' => $nilaiMappingRadio2[$request->input('pillar_five_question_two')] ?? null,
            'pillar_five_question_three' => $nilaiMappingRadio4[$request->input('pillar_five_question_three')] ?? null,
            'pillar_five_question_four' => $nilaiMappingRadio4[$request->input('pillar_five_question_four')] ?? null,
            'pillar_five_question_five' => $nilaiMappingRadio4[$request->input('pillar_five_question_five')] ?? null,
            'year' => $year
        ];

        SystemAssessment::updateOrCreate(
            ['id' => $request->input('id')],
            $data
        );

        return redirect()->back()->with('success', 'Nilai berhasil ditampilkan');
    }
}
