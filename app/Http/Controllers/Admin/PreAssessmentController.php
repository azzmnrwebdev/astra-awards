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
            ['class' => 'text-center py-3', 'label' => 'Kategori Area'],
            ['class' => 'text-center py-3', 'label' => 'Kategori'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
            ['class' => 'text-center py-3', 'label' => 'Status'],
            ['class' => 'text-center py-3', 'label' => 'Total Nilai'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $otherTheadName = [
            ['class' => 'text-center py-3', 'label' => 'Peringkat'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
            ['class' => 'text-center py-3', 'label' => 'Provinsi'],
            ['class' => 'text-center py-3', 'label' => 'Total Nilai'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $categoryAreas = CategoryArea::all();
        $categoryMosques = CategoryMosque::all();
        $committes = User::with(['distributionToCommitte'])->where('role', 'admin')
            ->whereHas('distributionToCommitte')->get();

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
        $year = $request->input('tahun', date('Y'));
        $query = User::with([
            'mosque',
            'mosque.pillarOneWithCustomYear' => fn($query) => $query->where('year', $year),
            'mosque.pillarTwoWithCustomYear' => fn($query) => $query->where('year', $year),
            'mosque.pillarThreeWithCustomYear' => fn($query) => $query->where('year', $year),
            'mosque.pillarFourWithCustomYear' => fn($query) => $query->where('year', $year),
            'mosque.pillarFiveWithCustomYear' => fn($query) => $query->where('year', $year),
            'mosque.pillarOneWithCustomYear.committeeAssessmentWithCustomYear' => fn($query) => $query->where('year', $year),
            'mosque.pillarTwoWithCustomYear.committeeAssessmentWithCustomYear' => fn($query) => $query->where('year', $year),
            'mosque.pillarThreeWithCustomYear.committeeAssessmentWithCustomYear' => fn($query) => $query->where('year', $year),
            'mosque.pillarFourWithCustomYear.committeeAssessmentWithCustomYear' => fn($query) => $query->where('year', $year),
            'mosque.pillarFiveWithCustomYear.committeeAssessmentWithCustomYear' => fn($query) => $query->where('year', $year),
            'distributions'
        ])->where('role', 'user');

        $categoryAreaId = $request->input('kategori_area');
        $categoryMosqueId = $request->input('kategori_masjid');
        $committeId = $request->input('panitia');
        $search = $request->input('pencarian');

        if ($categoryAreaId && $categoryMosqueId) {
            $query->whereHas('mosque', function ($q) use ($categoryAreaId, $categoryMosqueId) {
                $q->where('category_area_id', $categoryAreaId)
                    ->where('category_mosque_id', $categoryMosqueId);
            });
        }

        if ($committeId) {
            $query->whereHas('distributions', function ($q) use ($committeId) {
                $q->where('committe_id', $committeId);
            });
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('mosque', function ($q1) use ($search) {
                    $q1->whereRaw('LOWER(mosques.name) LIKE ?', ['%' . strtolower($search) . '%']);
                })
                    ->orWhereHas('mosque.company', function ($q2) use ($search) {
                        $q2->whereRaw('LOWER(companies.name) LIKE ?', ['%' . strtolower($search) . '%']);
                    });
            });
        }

        $query->where(function ($q) use ($year) {
            $pillars = ['pillarOneWithCustomYear', 'pillarTwoWithCustomYear', 'pillarThreeWithCustomYear', 'pillarFourWithCustomYear', 'pillarFiveWithCustomYear'];

            foreach ($pillars as $pillar) {
                $q->orWhereHas("mosque.$pillar", function ($subQuery) use ($year) {
                    $subQuery->where('year', $year)
                        ->orWhereHas('committeeAssessmentWithCustomYear', function ($nestedQuery) use ($year) {
                            $nestedQuery->where('year', $year);
                        });
                });
            }
        });

        $users = $query->paginate(10);

        $users->getCollection()->transform(
            function ($user) {
                $totalValue = 0;

                $weightPillarOne = 0.25;
                $weightPillarTwo = 0.25;
                $weightPillarThree = 0.20;
                $weightPillarFour = 0.15;
                $weightPillarFive = 0.15;

                $pillarOne = $user->mosque->pillarOneWithCustomYear;
                $pillarTwo = $user->mosque->pillarTwoWithCustomYear;
                $pillarThree = $user->mosque->pillarThreeWithCustomYear;
                $pillarFour = $user->mosque->pillarFourWithCustomYear;
                $pillarFive = $user->mosque->pillarFiveWithCustomYear;
                $pillarOneAssessments = $pillarOne?->committeeAssessmentWithCustomYear;
                $pillarTwoAssessments = $pillarTwo?->committeeAssessmentWithCustomYear;
                $pillarThreeAssessments = $pillarThree?->committeeAssessmentWithCustomYear;
                $pillarFourAssessments = $pillarFour?->committeeAssessmentWithCustomYear;
                $pillarFiveAssessments = $pillarFive?->committeeAssessmentWithCustomYear;

                if (
                    $pillarOne &&
                    $pillarOneAssessments
                ) {
                    $pillarOneTotal = 0;

                    $pillarOneTotal += $pillarOneAssessments->pillar_one_question_one;
                    $pillarOneTotal += $pillarOneAssessments->pillar_one_question_two;
                    $pillarOneTotal += $pillarOneAssessments->pillar_one_question_three;
                    $pillarOneTotal += $pillarOneAssessments->pillar_one_question_four;
                    $pillarOneTotal += $pillarOneAssessments->pillar_one_question_five;
                    $pillarOneTotal += $pillarOneAssessments->pillar_one_question_six;
                    $pillarOneTotal += $pillarOneAssessments->pillar_one_question_seven;

                    $totalValue += $pillarOneTotal * $weightPillarOne;
                }

                if (
                    $pillarTwo &&
                    $pillarTwoAssessments
                ) {
                    $pillarTwoTotal = 0;

                    $pillarTwoTotal += $pillarTwoAssessments->pillar_two_question_two;
                    $pillarTwoTotal += $pillarTwoAssessments->pillar_two_question_three;
                    $pillarTwoTotal += $pillarTwoAssessments->pillar_two_question_four;
                    $pillarTwoTotal += $pillarTwoAssessments->pillar_two_question_five;

                    $totalValue += $pillarTwoTotal * $weightPillarTwo;
                }

                if (
                    $pillarThree &&
                    $pillarThreeAssessments
                ) {
                    $pillarThreeTotal = 0;

                    $pillarThreeTotal += $pillarThreeAssessments->pillar_three_question_one;
                    $pillarThreeTotal += $pillarThreeAssessments->pillar_three_question_two;
                    $pillarThreeTotal += $pillarThreeAssessments->pillar_three_question_three;
                    $pillarThreeTotal += $pillarThreeAssessments->pillar_three_question_four;
                    $pillarThreeTotal += $pillarThreeAssessments->pillar_three_question_five;
                    $pillarThreeTotal += $pillarThreeAssessments->pillar_three_question_six;

                    $totalValue += $pillarThreeTotal * $weightPillarThree;
                }

                if (
                    $pillarFour &&
                    $pillarFourAssessments
                ) {
                    $pillarFourTotal = 0;

                    $pillarFourTotal += $pillarFourAssessments->pillar_four_question_one;
                    $pillarFourTotal += $pillarFourAssessments->pillar_four_question_two;
                    $pillarFourTotal += $pillarFourAssessments->pillar_four_question_three;
                    $pillarFourTotal += $pillarFourAssessments->pillar_four_question_four;
                    $pillarFourTotal += $pillarFourAssessments->pillar_four_question_five;

                    $totalValue += $pillarFourTotal * $weightPillarFour;
                }

                if (
                    $pillarFive &&
                    $pillarFiveAssessments
                ) {
                    $pillarFiveTotal = 0;

                    $pillarFiveTotal += $pillarFiveAssessments->pillar_five_question_one;
                    $pillarFiveTotal += $pillarFiveAssessments->pillar_five_question_two;
                    $pillarFiveTotal += $pillarFiveAssessments->pillar_five_question_three;
                    $pillarFiveTotal += $pillarFiveAssessments->pillar_five_question_four;
                    $pillarFiveTotal += $pillarFiveAssessments->pillar_five_question_five;

                    $totalValue += $pillarFiveTotal * $weightPillarFive;
                }

                $user->totalNilai = $totalValue;

                return $user;
            }
        );

        $sortedUsers = $users->getCollection()->sortByDesc('totalNilai');
        $users->setCollection($sortedUsers);

        // Menampilkan 5 data pengguna
        $categories = [];

        foreach ($categoryAreas as $area) {
            foreach ($categoryMosques as $mosque) {
                $topUsers = User::with([
                    'mosque',
                    'mosque.pillarOneWithCustomYear' => fn($query) => $query->where('year', $year),
                    'mosque.pillarTwoWithCustomYear' => fn($query) => $query->where('year', $year),
                    'mosque.pillarThreeWithCustomYear' => fn($query) => $query->where('year', $year),
                    'mosque.pillarFourWithCustomYear' => fn($query) => $query->where('year', $year),
                    'mosque.pillarFiveWithCustomYear' => fn($query) => $query->where('year', $year),
                    'mosque.pillarOneWithCustomYear.committeeAssessmentWithCustomYear' => fn($query) => $query->where('year', $year),
                    'mosque.pillarTwoWithCustomYear.committeeAssessmentWithCustomYear' => fn($query) => $query->where('year', $year),
                    'mosque.pillarThreeWithCustomYear.committeeAssessmentWithCustomYear' => fn($query) => $query->where('year', $year),
                    'mosque.pillarFourWithCustomYear.committeeAssessmentWithCustomYear' => fn($query) => $query->where('year', $year),
                    'mosque.pillarFiveWithCustomYear.committeeAssessmentWithCustomYear' => fn($query) => $query->where('year', $year),
                ])->whereHas('mosque', function ($q) use ($area, $mosque) {
                    $q->where('category_area_id', $area->id)->where('category_mosque_id', $mosque->id);
                })->get();

                $topUsers = $topUsers->map(function ($user) {
                    $totalValue = 0;

                    $weightPillarOne = 0.25;
                    $weightPillarTwo = 0.25;
                    $weightPillarThree = 0.20;
                    $weightPillarFour = 0.15;
                    $weightPillarFive = 0.15;

                    $pillarOne = $user->mosque->pillarOneWithCustomYear;
                    $pillarTwo = $user->mosque->pillarTwoWithCustomYear;
                    $pillarThree = $user->mosque->pillarThreeWithCustomYear;
                    $pillarFour = $user->mosque->pillarFourWithCustomYear;
                    $pillarFive = $user->mosque->pillarFiveWithCustomYear;
                    $pillarOneAssessments = $pillarOne?->committeeAssessmentWithCustomYear;
                    $pillarTwoAssessments = $pillarTwo?->committeeAssessmentWithCustomYear;
                    $pillarThreeAssessments = $pillarThree?->committeeAssessmentWithCustomYear;
                    $pillarFourAssessments = $pillarFour?->committeeAssessmentWithCustomYear;
                    $pillarFiveAssessments = $pillarFive?->committeeAssessmentWithCustomYear;

                    if (
                        $pillarOne &&
                        $pillarOneAssessments
                    ) {
                        $pillarOneTotal = 0;

                        $pillarOneTotal += $pillarOneAssessments->pillar_one_question_one;
                        $pillarOneTotal += $pillarOneAssessments->pillar_one_question_two;
                        $pillarOneTotal += $pillarOneAssessments->pillar_one_question_three;
                        $pillarOneTotal += $pillarOneAssessments->pillar_one_question_four;
                        $pillarOneTotal += $pillarOneAssessments->pillar_one_question_five;
                        $pillarOneTotal += $pillarOneAssessments->pillar_one_question_six;
                        $pillarOneTotal += $pillarOneAssessments->pillar_one_question_seven;

                        $totalValue += $pillarOneTotal * $weightPillarOne;
                    }

                    if (
                        $pillarTwo &&
                        $pillarTwoAssessments
                    ) {
                        $pillarTwoTotal = 0;

                        $pillarTwoTotal += $pillarTwoAssessments->pillar_two_question_two;
                        $pillarTwoTotal += $pillarTwoAssessments->pillar_two_question_three;
                        $pillarTwoTotal += $pillarTwoAssessments->pillar_two_question_four;
                        $pillarTwoTotal += $pillarTwoAssessments->pillar_two_question_five;

                        $totalValue += $pillarTwoTotal * $weightPillarTwo;
                    }

                    if (
                        $pillarThree &&
                        $pillarThreeAssessments
                    ) {
                        $pillarThreeTotal = 0;

                        $pillarThreeTotal += $pillarThreeAssessments->pillar_three_question_one;
                        $pillarThreeTotal += $pillarThreeAssessments->pillar_three_question_two;
                        $pillarThreeTotal += $pillarThreeAssessments->pillar_three_question_three;
                        $pillarThreeTotal += $pillarThreeAssessments->pillar_three_question_four;
                        $pillarThreeTotal += $pillarThreeAssessments->pillar_three_question_five;
                        $pillarThreeTotal += $pillarThreeAssessments->pillar_three_question_six;

                        $totalValue += $pillarThreeTotal * $weightPillarThree;
                    }

                    if (
                        $pillarFour &&
                        $pillarFourAssessments
                    ) {
                        $pillarFourTotal = 0;

                        $pillarFourTotal += $pillarFourAssessments->pillar_four_question_one;
                        $pillarFourTotal += $pillarFourAssessments->pillar_four_question_two;
                        $pillarFourTotal += $pillarFourAssessments->pillar_four_question_three;
                        $pillarFourTotal += $pillarFourAssessments->pillar_four_question_four;
                        $pillarFourTotal += $pillarFourAssessments->pillar_four_question_five;

                        $totalValue += $pillarFourTotal * $weightPillarFour;
                    }

                    if (
                        $pillarFive &&
                        $pillarFiveAssessments
                    ) {
                        $pillarFiveTotal = 0;

                        $pillarFiveTotal += $pillarFiveAssessments->pillar_five_question_one;
                        $pillarFiveTotal += $pillarFiveAssessments->pillar_five_question_two;
                        $pillarFiveTotal += $pillarFiveAssessments->pillar_five_question_three;
                        $pillarFiveTotal += $pillarFiveAssessments->pillar_five_question_four;
                        $pillarFiveTotal += $pillarFiveAssessments->pillar_five_question_five;

                        $totalValue += $pillarFiveTotal * $weightPillarFive;
                    }

                    $user->totalNilai = $totalValue;

                    return $user;
                })->filter(function ($user) {
                    return $user->totalNilai > 0;
                });

                $categories[] = [
                    'title' => $area->name . ' dan ' . $mosque->name,
                    'datas' => $topUsers->sortByDesc('totalNilai')->take(5),
                ];
            }
        }

        return view('admin.pages.assessment.pre-assessment', compact('theadName', 'otherTheadName', 'combinedData', 'committes', 'categoryAreaId', 'categoryMosqueId', 'committeId', 'search', 'users', 'categories'));
    }

    public function show(User $user, Request $request)
    {
        $year = $request->input('tahun', date('Y'));

        $distributions = $user->distributions()->with('committe')->get();
        $committees = $distributions->pluck('committe');

        $committeeAssessments = CommitteeAssessmentCommittee::whereHas('committeeAssessment', function ($query) use ($year) {
            $query->where('year', $year);
        })->with([
            'committeeAssessment.pillarOne',
            'committeeAssessment.pillarTwo',
            'committeeAssessment.pillarThree',
            'committeeAssessment.pillarFour',
            'committeeAssessment.pillarFive',
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
