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
            ['class' => 'text-center py-3', 'label' => 'Status'],
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

        $committeeAssessments = CommitteeAssessmentCommittee::with([
            'committeeAssessment.pillarOne',
            'committeeAssessment.pillarTwo',
            'committeeAssessment.pillarThree',
            'committeeAssessment.pillarFour',
            'committeeAssessment.pillarFive'
        ])->where('user_id', $user->id)->get();

        $pillarOne = null;
        $pillarTwo = null;
        $pillarThree = null;
        $pillarFour = null;
        $pillarFive = null;

        $historyAssessmentPillarOnes = [];
        $historyAssessmentPillarTwos = [];
        $historyAssessmentPillarThrees = [];
        $historyAssessmentPillarFours = [];
        $historyAssessmentPillarFives = [];

        foreach ($committeeAssessments as $assessment) {
            $position = $assessment->position;
            $positions = preg_split('/(?<=dinilai,|diubah,)/', $position);
            $positions = array_map(function ($pos) {
                return rtrim(trim($pos), ',');
            }, $positions);

            if (strpos($position, 'Hubungan DKM dengan YAA') !== false) {
                $pillarTwo = $assessment->committeeAssessment;
                $historyAssessmentPillarTwos[$assessment->committee_id] = $positions;
            } elseif (
                strpos(
                    $position,
                    'Hubungan Manajemen Perusahaan dengan DKM dan Jamaah',
                ) !== false
            ) {
                $pillarOne = $assessment->committeeAssessment;
                $historyAssessmentPillarOnes[$assessment->committee_id] = $positions;
            } elseif (strpos($position, 'Program Sosial') !== false) {
                $pillarThree = $assessment->committeeAssessment;
                $historyAssessmentPillarThrees[$assessment->committee_id] = $positions;
            } elseif (strpos($position, 'Administrasi dan Keuangan') !== false) {
                $pillarFour = $assessment->committeeAssessment;
                $historyAssessmentPillarFours[$assessment->committee_id] = $positions;
            } elseif (
                strpos($position, 'Peribadahan dan Infrastruktur') !== false
            ) {
                $pillarFive = $assessment->committeeAssessment;
                $historyAssessmentPillarFives[$assessment->committee_id] = $positions;
            }
        }

        // dd($historyAssessmentPillarTwos);

        return view('admin.pages.assessment.pre-assessment-show', compact('user', 'committees', 'pillarOne', 'pillarTwo', 'pillarThree', 'pillarFour', 'pillarFive', 'historyAssessmentPillarOnes', 'historyAssessmentPillarTwos', 'historyAssessmentPillarThrees', 'historyAssessmentPillarFours', 'historyAssessmentPillarFives'));
    }
}
