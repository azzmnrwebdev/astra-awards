<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CategoryArea;
use Illuminate\Http\Request;
use App\Models\CategoryMosque;
use App\Models\StartAssessment;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class StartAssessmentController extends Controller
{
    public function presentationAssessmentAct(Request $request)
    {
        if (!$request->input('presentation_file')) {
            return redirect()->back()->with('error', 'Penilaian tidak boleh kosong.');
        }

        StartAssessment::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'presentation_id' => $request->input('presentation_id'),
                'presentation_file' => $request->input('presentation_file')
            ]
        );

        return redirect()->back()->with('success', 'Nilai berhasil disimpan');
    }

    public function index(Request $request)
    {
        $categoryAreas = CategoryArea::all();
        $categoryMosques = CategoryMosque::all();

        $theadName = $this->getTheadName();
        $categoryTheadName = $this->getCategoryTheadName();

        // Gabungkan data kategori
        $combinedData = $this->getCombinedCategoryData($categoryAreas, $categoryMosques);

        // Ambil input filter dari request
        $categoryAreaId = $request->input('kategori_area');
        $categoryMosqueId = $request->input('kategori_masjid');
        $search = $request->input('pencarian');

        // Menampilkan semua data pengguna
        $allUsers = collect();

        foreach ($categoryAreas as $area) {
            foreach ($categoryMosques as $mosque) {
                $users = User::with([
                    'mosque',
                    'mosque.company',
                    'mosque.presentation',
                ])->whereHas('mosque', function ($q) use ($area, $mosque) {
                    $q->where('category_area_id', $area->id)->where('category_mosque_id', $mosque->id);
                })->where(function ($q) {
                    $q->whereHas('mosque.presentation');
                })->when($categoryAreaId && $categoryMosqueId, function ($query) use ($categoryAreaId, $categoryMosqueId) {
                    $query->whereHas('mosque', function ($q) use ($categoryAreaId, $categoryMosqueId) {
                        $q->where('category_area_id', $categoryAreaId)
                            ->where('category_mosque_id', $categoryMosqueId);
                    });
                })->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->whereHas('mosque', function ($mosqueQuery) use ($search) {
                            $mosqueQuery->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
                        })->orWhereHas('mosque.company', function ($companyQuery) use ($search) {
                            $companyQuery->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
                        });
                    });
                })->get();

                $users = $users->map(function ($user) {
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

                    if ($user->mosque->presentation && $user->mosque->presentation->startAssessment) {
                        $totalValue += $user->mosque->presentation->startAssessment->presentation_file;
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
                })->take(3)->get();

                $topUsers = $topUsers->map(function ($user) {
                    $totalValue = 0;

                    if ($user->mosque->presentation && $user->mosque->presentation->startAssessment) {
                        $totalValue += $user->mosque->presentation->startAssessment->presentation_file;

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

        return view('admin.pages.assessment.start-assessment', compact('theadName', 'categoryTheadName', 'combinedData', 'categoryAreaId', 'categoryMosqueId', 'search', 'paginatedUsers', 'categories'));
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
            ['class' => 'text-center py-3', 'label' => 'Kategori'],
            ['class' => 'text-center py-3', 'label' => 'Kategori Area'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
            ['class' => 'text-center py-3', 'label' => 'Status'],
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
