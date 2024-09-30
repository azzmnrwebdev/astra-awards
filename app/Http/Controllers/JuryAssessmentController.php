<?php

namespace App\Http\Controllers;

use App\Models\JuryAssessment;
use Illuminate\Http\Request;

class JuryAssessmentController extends Controller
{
    public function presentationAssessmentAct(Request $request)
    {
        if (!$request->input('presentation_file')) {
            return redirect()->back()->with('error', 'Penilaian tidak boleh kosong.');
        }

        JuryAssessment::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'presentation_id' => $request->input('presentation_id'),
                'presentation_file' => $request->input('presentation_file')
            ]
        );

        return redirect()->back()->with('success', 'Nilai berhasil disimpan');
    }
}
