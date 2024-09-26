<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CommitteeAssessmentCommittee;

class PreAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama Peerta'],
            ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Total Nilai'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $users = User::where('role', 'user')->orderByDesc('updated_at')->latest('created_at')->paginate(10);

        return view('admin.pages.assessment.pre-assessment', compact('theadName', 'users'));
    }

    public function show(User $user)
    {
        $distributions = $user->distributions()->with('committe')->get();
        $committees = $distributions->pluck('committe');

        $assessments = [];

        foreach ($committees as $committee) {
            $committeeAssessments = CommitteeAssessmentCommittee::with([
                'committeeAssessment.pillarOne',
                'committeeAssessment.pillarTwo',
                'committeeAssessment.pillarThree',
                'committeeAssessment.pillarFour',
                'committeeAssessment.pillarFive'
            ])->where('user_id', $user->id)->where('committee_id', $committee->id)->get();

            $assessments[$committee->id] = $committeeAssessments;
        }

        return view('admin.pages.assessment.pre-assessment-show', compact('user', 'committees', 'assessments'));
    }
}
