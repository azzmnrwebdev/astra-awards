<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommitteeAssessment;
use Illuminate\Support\Facades\Auth;
use App\Models\CommitteeAssessmentCommittee;

class CommitteeAssessmentController extends Controller
{
    public function pillarOneAct(Request $request)
    {
        //
    }

    public function pillarTwoAct(Request $request)
    {
        if (
            !$request->input('committee_pillar_two_question_one') &&
            !$request->input('committee_pillar_two_question_two') &&
            !$request->input('committee_pillar_two_question_three') &&
            !$request->input('committee_pillar_two_question_four') &&
            !$request->input('committee_pillar_two_question_five')
        ) {
            return redirect()->back()->with('error_assessment', 'Harus menilai setidaknya salah satu bidang data.');
        }

        $data = [
            'pillar_two_question_one' => $request->input('committee_pillar_two_question_one'),
            'pillar_two_question_two' => $request->input('committee_pillar_two_question_two'),
            'pillar_two_question_three' => $request->input('committee_pillar_two_question_three'),
            'pillar_two_question_four' => $request->input('committee_pillar_two_question_four'),
            'pillar_two_question_five' => $request->input('committee_pillar_two_question_five'),
        ];

        $committeeAssessment = CommitteeAssessment::where('pillar_two_id', $request->input('pillar_two_id'))->first();

        if ($committeeAssessment) {
            $currentPosition = CommitteeAssessmentCommittee::where('committee_assessment_id', $committeeAssessment->id)
                ->where('committee_id', Auth::id())
                ->first();

            $positionParts = $currentPosition ? explode(', ', $currentPosition->position) : [];

            foreach ($data as $key => $value) {
                $questionNumber = $this->get4QuestionNumber($key);

                if (is_null($value)) {
                    $positionParts = array_filter($positionParts, function ($position) use ($questionNumber) {
                        return $position !== "$questionNumber sudah di nilai";
                    });
                } elseif ($committeeAssessment->{$key} != $value) {
                    if (!in_array("$questionNumber sudah di nilai", $positionParts)) {
                        $positionParts[] = "$questionNumber sudah di nilai";
                    }
                }
            }

            $positionParts = array_filter($positionParts);
            $position = implode(', ', array_unique($positionParts));

            $committeeAssessment->update($data);

            if ($currentPosition) {
                $currentPosition->update(['position' => $position]);
            } else {
                CommitteeAssessmentCommittee::create([
                    'committee_assessment_id' => $committeeAssessment->id,
                    'committee_id' => Auth::id(),
                    'position' => $position
                ]);
            }
        } else {
            $committeeAssessment = CommitteeAssessment::create(array_merge(['pillar_two_id' => $request->input('pillar_two_id')], $data));

            $positionParts = [];

            foreach ($data as $key => $value) {
                if (!is_null($value)) {
                    $positionParts[] = $this->get4QuestionNumber($key) . " sudah di nilai";
                }
            }

            $position = implode(', ', array_filter($positionParts));

            CommitteeAssessmentCommittee::create([
                'committee_assessment_id' => $committeeAssessment->id,
                'committee_id' => Auth::id(),
                'position' => $position
            ]);
        }

        return redirect()->back()->with('success_assessment', 'Nilai berhasil disimpan');
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

    private function get4QuestionNumber($key)
    {
        $mapping = [
            'pillar_two_question_one' => 'Pertanyaan 1',
            'pillar_two_question_two' => 'Pertanyaan 2',
            'pillar_two_question_three' => 'Pertanyaan 3',
            'pillar_two_question_four' => 'Pertanyaan 4',
            'pillar_two_question_five' => 'Pertanyaan 5',
        ];

        return $mapping[$key] ?? '';
    }
}
