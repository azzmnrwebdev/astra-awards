<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CategoryArea;
use App\Models\CategoryMosque;
use App\Http\Controllers\Controller;
use App\Models\CommitteeAssessmentCommittee;

class PreAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-center py-3', 'label' => 'Kategori'],
            ['class' => 'text-center py-3', 'label' => 'Kategori Area'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
            ['class' => 'text-center py-3', 'label' => 'Status'],
            ['class' => 'text-center py-3', 'label' => 'Total Nilai'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $otherTheadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
            ['class' => 'text-center py-3', 'label' => 'Total Nilai'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $categoryAreas = CategoryArea::all();
        $categoryMosques = CategoryMosque::all();

        // Gabungkan data kategori
        $combinedData = [];

        foreach ($categoryAreas as $area) {
            foreach ($categoryMosques as $mosque) {
                $combinedData[] = [
                    'label' => $area->name . ' - ' . $mosque->name,
                    'value' => $area->id . '-' . $mosque->id,
                ];
            }
        }

        // Menampilkan semua data pengguna
        $query = User::with([
            'mosque',
            'mosque.pillarOne',
            'mosque.pillarTwo',
            'mosque.pillarThree',
            'mosque.pillarFour',
            'mosque.pillarFive'
        ])->where('role', 'user');

        $categoryAreaId = $request->input('kategori_area');
        $categoryMosqueId = $request->input('kategori_masjid');
        $search = $request->input('pencarian');

        if ($categoryAreaId && $categoryMosqueId) {
            $query->whereHas('mosque', function ($q) use ($categoryAreaId, $categoryMosqueId) {
                $q->where('category_area_id', $categoryAreaId)
                    ->where('category_mosque_id', $categoryMosqueId);
            });
        }

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

        $query->where(function ($q) {
            $q->whereHas('mosque.pillarOne')
                ->orWhereHas('mosque.pillarTwo')
                ->orWhereHas('mosque.pillarThree')
                ->orWhereHas('mosque.pillarFour')
                ->orWhereHas('mosque.pillarFive');
        });

        if ($categoryAreaId && $categoryMosqueId) {
            $users = $query->select('users.*')
                ->leftJoin('mosques', 'mosques.user_id', '=', 'users.id')
                ->leftJoin('pillar_ones', 'pillar_ones.mosque_id', '=', 'mosques.id')
                ->leftJoin('pillar_twos', 'pillar_twos.mosque_id', '=', 'mosques.id')
                ->leftJoin('pillar_threes', 'pillar_threes.mosque_id', '=', 'mosques.id')
                ->leftJoin('pillar_fours', 'pillar_fours.mosque_id', '=', 'mosques.id')
                ->leftJoin('pillar_fives', 'pillar_fives.mosque_id', '=', 'mosques.id')
                ->selectRaw('
                (COALESCE(
                    (SELECT SUM(pillar_one_question_one + pillar_one_question_two + pillar_one_question_three + pillar_one_question_four + pillar_one_question_five + pillar_one_question_six + pillar_one_question_seven)
                    FROM committee_assessments WHERE committee_assessments.pillar_one_id = pillar_ones.id), 0)
                +
                COALESCE(
                    (SELECT SUM(pillar_two_question_two + pillar_two_question_three + pillar_two_question_four + pillar_two_question_five)
                    FROM committee_assessments WHERE committee_assessments.pillar_two_id = pillar_twos.id), 0)
                +
                COALESCE(
                    (SELECT SUM(pillar_three_question_one + pillar_three_question_two + pillar_three_question_three + pillar_three_question_four + pillar_three_question_five + pillar_three_question_six)
                    FROM committee_assessments WHERE committee_assessments.pillar_three_id = pillar_threes.id), 0)
                +
                COALESCE(
                    (SELECT SUM(pillar_four_question_one + pillar_four_question_two + pillar_four_question_three + pillar_four_question_four + pillar_four_question_five)
                    FROM committee_assessments WHERE committee_assessments.pillar_four_id = pillar_fours.id), 0)
                +
                COALESCE(
                    (SELECT SUM(pillar_five_question_one + pillar_five_question_two + pillar_five_question_three + pillar_five_question_four + pillar_five_question_five)
                    FROM committee_assessments WHERE committee_assessments.pillar_five_id = pillar_fives.id), 0)
                ) AS "totalPillarValue"
            ')->orderByDesc('totalPillarValue')->paginate(10);
        } else {
            $users = $query->orderByDesc('users.updated_at')->latest('users.created_at')->paginate(10);
        }

        // Menampilkan 5 data pengguna
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
                })->filter(function ($user) {
                    return $user->totalNilai > 0;
                })->sortByDesc('totalNilai');

                $categories[] = [
                    'title' => $area->name . ' dan ' . $mosque->name,
                    'datas' => $topUsers,
                ];
            }
        }

        return view('admin.pages.assessment.pre-assessment', compact('theadName', 'otherTheadName', 'combinedData', 'categoryAreaId', 'categoryMosqueId', 'search', 'users', 'categories'));
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

            $formattedPositions = [];

            foreach ($positions as $pos) {
                if (strpos($pos, 'dinilai') !== false) {
                    $formattedPositions[] = [
                        'position' => $pos,
                        'created_at' => $assessment->created_at
                    ];
                } elseif (strpos($pos, 'diubah') !== false) {
                    $formattedPositions[] = [
                        'position' => $pos,
                        'updated_at' => $assessment->updated_at
                    ];
                } else {
                    $formattedPositions[] = [
                        'position' => $pos
                    ];
                }
            }

            if (strpos($position, 'Hubungan DKM dengan YAA') !== false) {
                $pillarTwo = $assessment->committeeAssessment;
                $historyAssessmentPillarTwos[$assessment->committee_id] = $formattedPositions;
            } elseif (
                strpos(
                    $position,
                    'Hubungan Manajemen Perusahaan dengan DKM dan Jamaah',
                ) !== false
            ) {
                $pillarOne = $assessment->committeeAssessment;
                $historyAssessmentPillarOnes[$assessment->committee_id] = $formattedPositions;
            } elseif (strpos($position, 'Program Sosial') !== false) {
                $pillarThree = $assessment->committeeAssessment;
                $historyAssessmentPillarThrees[$assessment->committee_id] = $formattedPositions;
            } elseif (strpos($position, 'Administrasi dan Keuangan') !== false) {
                $pillarFour = $assessment->committeeAssessment;
                $historyAssessmentPillarFours[$assessment->committee_id] = $formattedPositions;
            } elseif (
                strpos($position, 'Peribadahan dan Infrastruktur') !== false
            ) {
                $pillarFive = $assessment->committeeAssessment;
                $historyAssessmentPillarFives[$assessment->committee_id] = $formattedPositions;
            }
        }

        return view('admin.pages.assessment.pre-assessment-show', compact('user', 'committees', 'pillarOne', 'pillarTwo', 'pillarThree', 'pillarFour', 'pillarFive', 'historyAssessmentPillarOnes', 'historyAssessmentPillarTwos', 'historyAssessmentPillarThrees', 'historyAssessmentPillarFours', 'historyAssessmentPillarFives'));
    }
}
