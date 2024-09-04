<?php

namespace App\Http\Controllers;

use App\Models\SystemAssessment;
use Illuminate\Http\Request;

class SystemAssessmentController extends Controller
{
    public function pillarOneAct(Request $request)
    {
        $nilaiMapping = [
            1 => 1,
            2 => 3,
            3 => 7,
            4 => 9,
        ];

        // Map the values using nilaiMapping
        $data = [
            'pillar_one_question_one' => $nilaiMapping[$request->input('pillar_one_question_one')] ?? null,
            'pillar_one_question_two' => $nilaiMapping[$request->input('pillar_one_question_two')] ?? null,
            'pillar_one_question_three' => $nilaiMapping[$request->input('pillar_one_question_three')] ?? null,
            'pillar_one_question_four' => $nilaiMapping[$request->input('pillar_one_question_four')] ?? null,
            'pillar_one_question_five' => $nilaiMapping[$request->input('pillar_one_question_five')] ?? null,
        ];

        // Use the mapped values to update or create the record
        SystemAssessment::updateOrCreate(
            ['pillar_one_id' => $request->input('pillar_one_id')],
            $data
        );

        // Redirect or return a response as needed
        return redirect()->back()->with('success_assessment', 'Nilai berhasil ditampilkan');
    }
}
