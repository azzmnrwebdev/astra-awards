<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryArea;
use App\Models\CategoryMosque;
use App\Models\CommitteeAssessmentCommittee;

class PreAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama Peserta'],
            ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Status'],
            ['class' => 'text-center py-3', 'label' => 'Total Nilai'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $otherTheadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama Peserta'],
            ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Total Nilai'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $categoryAreas = CategoryArea::all();
        $categoryMosques = CategoryMosque::all();
        $search = $request->input('pencarian');

        $query = User::where('role', 'user');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(users.name) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhereHas('mosque', function ($q1) use ($search) {
                        $q1->whereRaw('LOWER(mosques.name) LIKE ?', ['%' . strtolower($search) . '%']);
                    })
                    ->orWhereHas('mosque.company', function ($q2) use ($search) {
                        $q2->whereRaw('LOWER(companies.name) LIKE ?', ['%' . strtolower($search) . '%']);
                    });
            });
        }

        $users = $query->orderByDesc('users.updated_at')->latest('users.created_at')->paginate(10);

        $categories = [];

        foreach ($categoryAreas as $area) {
            foreach ($categoryMosques as $mosque) {
                $topUsers = User::with(['mosque.pillarOne.committeeAssessmnet', 'mosque.pillarTwo.committeeAssessmnet', 'mosque.pillarThree.committeeAssessmnet', 'mosque.pillarFour.committeeAssessmnet', 'mosque.pillarFive.committeeAssessmnet'])
                    ->whereHas('mosque', function ($q) use ($area, $mosque) {
                        $q->where('category_area_id', $area->id)->where('category_mosque_id', $mosque->id);
                    })->take(5)->get();

                $topUsers = $topUsers->map(function ($user) {
                    $totalValue = 0;

                    if ($user->mosque->pillarOne && $user->mosque->pillarOne->committeeAssessmnet) {
                        $totalValue += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_one;
                        $totalValue += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_two;
                        $totalValue += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_three;
                        $totalValue += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_four;
                        $totalValue += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_five;
                        $totalValue += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_six;
                        $totalValue += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_seven;
                    }

                    if ($user->mosque->pillarTwo && $user->mosque->pillarTwo->committeeAssessmnet) {
                        $totalValue += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_two;
                        $totalValue += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_three;
                        $totalValue += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_four;
                        $totalValue += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_five;
                    }

                    if ($user->mosque->pillarThree && $user->mosque->pillarThree->committeeAssessmnet) {
                        $totalValue += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_one;
                        $totalValue += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_two;
                        $totalValue += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_three;
                        $totalValue += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_four;
                        $totalValue += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_five;
                        $totalValue += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_six;
                    }

                    if ($user->mosque->pillarFour && $user->mosque->pillarFour->committeeAssessmnet) {
                        $totalValue += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_one;
                        $totalValue += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_two;
                        $totalValue += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_three;
                        $totalValue += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_four;
                        $totalValue += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_five;
                    }

                    if ($user->mosque->pillarFive && $user->mosque->pillarFive->committeeAssessmnet) {
                        $totalValue += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_one;
                        $totalValue += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_two;
                        $totalValue += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_three;
                        $totalValue += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_four;
                        $totalValue += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_five;
                    }

                    $user->totalNilai = $totalValue;

                    return $user;
                })->sortByDesc('totalNilai');

                $categories[] = [
                    'title' => $area->name . ' dan ' . $mosque->name,
                    'datas' => $topUsers,
                ];
            }
        }

        return view('admin.pages.assessment.pre-assessment', compact('theadName', 'otherTheadName', 'search', 'users', 'categories'));
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
