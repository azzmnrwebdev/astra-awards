<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CategoryArea;
use Illuminate\Http\Request;
use App\Models\CategoryMosque;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class StartAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $categoryAreas = CategoryArea::all();
        $categoryMosques = CategoryMosque::all();
        $juries = User::where('role', 'jury')->get();

        if ($user->role == 'admin') {
            $theadName = [
                ['class' => 'text-center py-3', 'label' => 'No'],
                ['class' => 'text-center py-3', 'label' => 'Kategori Area'],
                ['class' => 'text-center py-3', 'label' => 'Kategori'],
                ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
                ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
                ['class' => 'text-center py-3', 'label' => 'Total Nilai'],
                ['class' => 'text-center py-3', 'label' => 'Aksi'],
            ];
        } else {
            $theadName = [
                ['class' => 'text-center py-3', 'label' => 'No'],
                ['class' => 'text-center py-3', 'label' => 'Kategori Area'],
                ['class' => 'text-center py-3', 'label' => 'Kategori'],
                ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
                ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
                ['class' => 'text-center py-3', 'label' => 'Total Nilai<br />Per Juri'],
                ['class' => 'text-center py-3', 'label' => 'Total Nilai<br />Keluruhan Juri'],
                ['class' => 'text-center py-3', 'label' => 'Aksi'],
            ];
        }

        $categoryTheadName = $this->getCategoryTheadName();

        // Gabungkan data kategori
        $combinedData = $this->getCombinedCategoryData($categoryAreas, $categoryMosques);

        // Ambil input filter dari request
        $categoryAreaId = $request->input('kategori_area');
        $categoryMosqueId = $request->input('kategori_masjid');
        $juryId = $request->input('juri');
        $search = $request->input('pencarian');

        // Menampilkan semua data pengguna
        $allUsers = collect();

        foreach ($categoryAreas as $area) {
            foreach ($categoryMosques as $mosque) {
                $users = User::with([
                    'mosque',
                    'mosque.company',
                    'mosque.presentation',
                    'mosque.presentation.startAssessment',
                    'mosque.pillarOne.committeeAssessmnet',
                    'mosque.pillarTwo.committeeAssessmnet',
                    'mosque.pillarThree.committeeAssessmnet',
                    'mosque.pillarFour.committeeAssessmnet',
                    'mosque.pillarFive.committeeAssessmnet'
                ])->whereHas('mosque', function ($q) use ($area, $mosque) {
                    $q->where('category_area_id', $area->id)->where('category_mosque_id', $mosque->id);
                })->where(function ($q) {
                    $q->whereHas('mosque.presentation');
                })->when($categoryAreaId && $categoryMosqueId, function ($query) use ($categoryAreaId, $categoryMosqueId) {
                    $query->whereHas('mosque', function ($q) use ($categoryAreaId, $categoryMosqueId) {
                        $q->where('category_area_id', $categoryAreaId)
                            ->where('category_mosque_id', $categoryMosqueId);
                    });
                })->when($juryId, function ($query) use ($juryId) {
                    $query->where(function ($q) use ($juryId) {
                        $q->whereHas('mosque.presentation.startAssessment', function ($q2) use ($juryId) {
                            $q2->where('jury_id', $juryId);
                        });
                    });
                })->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->whereHas('mosque', function ($q2) use ($search) {
                            $q2->where('name', 'LIKE', '%' . strtolower($search) . '%');
                        })->orWhereHas('mosque.company', function ($q3) use ($search) {
                            $q3->where('name', 'LIKE', '%' . strtolower($search) . '%');
                        });
                    });
                })->get();

                $users = $users->map(function ($user) {
                    $totalValue = 0;

                    $weightPillarOne = 0.25;
                    $weightPillarTwo = 0.25;
                    $weightPillarThree = 0.20;
                    $weightPillarFour = 0.15;
                    $weightPillarFive = 0.15;

                    if ($user->mosque->pillarOne && $user->mosque->pillarOne->committeeAssessmnet) {
                        $pillarOneTotal = 0;
                        $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_one;
                        $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_two;
                        $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_three;
                        $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_four;
                        $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_five;
                        $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_six;
                        $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_seven;

                        $totalValue += $pillarOneTotal * $weightPillarOne;
                    }

                    if ($user->mosque->pillarTwo && $user->mosque->pillarTwo->committeeAssessmnet) {
                        $pillarTwoTotal = 0;
                        $pillarTwoTotal += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_two;
                        $pillarTwoTotal += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_three;
                        $pillarTwoTotal += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_four;
                        $pillarTwoTotal += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_five;

                        $totalValue += $pillarTwoTotal * $weightPillarTwo;
                    }

                    if ($user->mosque->pillarThree && $user->mosque->pillarThree->committeeAssessmnet) {
                        $pillarThreeTotal = 0;
                        $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_one;
                        $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_two;
                        $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_three;
                        $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_four;
                        $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_five;
                        $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_six;

                        $totalValue += $pillarThreeTotal * $weightPillarThree;
                    }

                    if ($user->mosque->pillarFour && $user->mosque->pillarFour->committeeAssessmnet) {
                        $pillarFourTotal = 0;
                        $pillarFourTotal += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_one;
                        $pillarFourTotal += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_two;
                        $pillarFourTotal += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_three;
                        $pillarFourTotal += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_four;
                        $pillarFourTotal += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_five;

                        $totalValue += $pillarFourTotal * $weightPillarFour;
                    }

                    if ($user->mosque->pillarFive && $user->mosque->pillarFive->committeeAssessmnet) {
                        $pillarFiveTotal = 0;
                        $pillarFiveTotal += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_one;
                        $pillarFiveTotal += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_two;
                        $pillarFiveTotal += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_three;
                        $pillarFiveTotal += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_four;
                        $pillarFiveTotal += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_five;

                        $totalValue += $pillarFiveTotal * $weightPillarFive;
                    }

                    $user->totalNilai = $totalValue;

                    return $user;
                })->filter(function ($user) {
                    return $user->totalNilai > 0;
                });

                $topUsers = $users->sortByDesc('totalNilai')->take(5);
                $allUsers = $allUsers->merge($topUsers);
            }
        }

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $paginatedUsers = new LengthAwarePaginator(
            $allUsers->forPage($currentPage, $perPage),
            $allUsers->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // Menampilkan 3 data pengguna
        $categories = [];

        foreach ($categoryAreas as $area) {
            foreach ($categoryMosques as $mosque) {
                $topUsers = User::with([
                    'mosque',
                    'mosque.presentation',
                    'mosque.presentation.startAssessment'
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

                    if ($user->mosque->presentation && $user->mosque->presentation->startAssessment->isNotEmpty()) {
                        $totalPillarOne = $user->mosque->presentation->startAssessment->sum('presentation_file_pillar_one');
                        $totalPillarTwo = $user->mosque->presentation->startAssessment->sum('presentation_file_pillar_two');
                        $totalPillarThree = $user->mosque->presentation->startAssessment->sum('presentation_file_pillar_three');
                        $totalPillarFour = $user->mosque->presentation->startAssessment->sum('presentation_file_pillar_four');
                        $totalPillarFive = $user->mosque->presentation->startAssessment->sum('presentation_file_pillar_five');

                        $totalValue += $totalPillarOne * $weightPillarOne;
                        $totalValue += $totalPillarTwo * $weightPillarTwo;
                        $totalValue += $totalPillarThree * $weightPillarThree;
                        $totalValue += $totalPillarFour * $weightPillarFour;
                        $totalValue += $totalPillarFive * $weightPillarFive;
                    }

                    $user->totalNilai = $totalValue;

                    return $user;
                })->filter(function ($user) {
                    return $user->totalNilai > 0;
                });

                $categories[] = [
                    'title' => $area->name . ' dan ' . $mosque->name,
                    'datas' => $topUsers->sortByDesc('totalNilai')->take(3),
                ];
            }
        }

        return view('admin.pages.assessment.start-assessment', compact('theadName', 'categoryTheadName', 'combinedData', 'juries', 'categoryAreaId', 'categoryMosqueId', 'juryId', 'search', 'paginatedUsers', 'categories'));
    }

    public function show(User $user)
    {
        return view('admin.pages.assessment.start-assessment-show', compact('user'));
    }

    // Kebutuhan Method Index
    private function getTheadName()
    {
        return [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-center py-3', 'label' => 'Kategori Area'],
            ['class' => 'text-center py-3', 'label' => 'Kategori'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
            ['class' => 'text-center py-3', 'label' => 'Total Nilai'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];
    }

    private function getCategoryTheadName()
    {
        return [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
            ['class' => 'text-center py-3', 'label' => 'Provinsi'],
            ['class' => 'text-center py-3', 'label' => 'Total Nilai'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];
    }

    private function getCombinedCategoryData($categoryAreas, $categoryMosques)
    {
        $combinedData = [];

        foreach ($categoryAreas as $area) {
            foreach ($categoryMosques as $mosque) {
                $combinedData[] = [
                    'label' => "{$area->name} - {$mosque->name}",
                    'value' => "{$area->id}-{$mosque->id}",
                ];
            }
        }

        return $combinedData;
    }
}
