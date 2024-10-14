<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\CategoryArea;
use Illuminate\Http\Request;
use App\Models\CategoryMosque;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class EndAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $categoryAreas = CategoryArea::all();
        $categoryMosques = CategoryMosque::all();
        $juries = User::where('role', 'jury')->get();

        $endAssessmentTheadNames = $this->getTheadName([
            'No',
            'Kategori',
            'Kategori Area',
            'Nama Masjid/Musala',
            'Perusahaan',
            'Total Nilai',
        ]);

        $startAssessmentTheadNames = $this->getTheadName([
            'No',
            'Kategori',
            'Kategori Area',
            'Nama Masjid/Musala',
            'Perusahaan',
            'Aksi',
        ]);

        $categoryTheadNames = $this->getTheadName([
            'No',
            'Nama Masjid/Musala',
            'Perusahaan',
            'Total Nilai',
        ]);

        // Gabungkan data kategori
        $combinedData = $this->getCombinedCategoryData($categoryAreas, $categoryMosques);

        // Ambil input filter dari request
        $categoryAreaId = $request->input('kategori_area');
        $categoryMosqueId = $request->input('kategori_masjid');
        $juryId = $request->input('juri');
        $search = $request->input('pencarian');

        // Menampilkan semua data pengguna penilaian akhir
        $endAssessmentUsers = collect();

        foreach ($categoryAreas as $area) {
            foreach ($categoryMosques as $mosque) {
                $users = User::with([
                    'mosque',
                    'mosque.company',
                    'mosque.endAssessment'
                ])->whereHas('mosque', function ($q) use ($area, $mosque) {
                    $q->where('category_area_id', $area->id)->where('category_mosque_id', $mosque->id);
                })->when($categoryAreaId && $categoryMosqueId, function ($query) use ($categoryAreaId, $categoryMosqueId) {
                    $query->whereHas('mosque', function ($q) use ($categoryAreaId, $categoryMosqueId) {
                        $q->where('category_area_id', $categoryAreaId)
                            ->where('category_mosque_id', $categoryMosqueId);
                    });
                })->when($juryId, function ($query) use ($juryId) {
                    $query->where(function ($q) use ($juryId) {
                        $q->whereHas('mosque.endAssessment', function ($q2) use ($juryId) {
                            $q2->where('jury_id', $juryId);
                        });
                    });
                })->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->whereHas('mosque', function ($q2) use ($search) {
                            $q2->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
                        })->orWhereHas('mosque.company', function ($q3) use ($search) {
                            $q3->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
                        });
                    });
                })->get();

                $users = $users->map(function ($user) {
                    $totalValue = 0;

                    if ($user->mosque->endAssessment) {
                        $totalValue += $user->mosque->endAssessment->presentation_value;

                        if ($user->mosque->presentation && $user->mosque->presentation->startAssessment) {
                            $totalValue += $user->mosque->presentation->startAssessment->presentation_file;
                        }

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
                });

                $topUsers = $users->sortByDesc('totalNilai');
                $endAssessmentUsers = $endAssessmentUsers->merge($topUsers);
            }
        }

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $endAssessmentAllUsers = new LengthAwarePaginator(
            $endAssessmentUsers->forPage($currentPage, $perPage),
            $endAssessmentUsers->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // Menampilkan semua data pengguna penilaian awal
        $startAssessmentUsers = collect();

        foreach ($categoryAreas as $area) {
            foreach ($categoryMosques as $mosque) {
                $users = User::with([
                    'mosque',
                    'mosque.company',
                    'mosque.presentation',
                    'mosque.presentation.startAssessment'
                ])->whereHas('mosque', function ($q) use ($area, $mosque) {
                    $q->where('category_area_id', $area->id)->where('category_mosque_id', $mosque->id);
                })->where(function ($q) {
                    $q->whereHas('mosque.presentation');
                })->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->whereHas('mosque', function ($q2) use ($search) {
                            $q2->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
                        })->orWhereHas('mosque.company', function ($q3) use ($search) {
                            $q3->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
                        });
                    });
                })->get();

                $users = $users->map(function ($user) {
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
                });

                $topUsers = $users->sortByDesc('totalNilai');
                $startAssessmentUsers = $startAssessmentUsers->merge($topUsers);
            }
        }

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $usersInStartAssessment = new LengthAwarePaginator(
            $startAssessmentUsers->forPage($currentPage, $perPage),
            $startAssessmentUsers->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // Menampilkan juara 1, 2 dan 3
        $categories = [];

        foreach ($categoryAreas as $area) {
            foreach ($categoryMosques as $mosque) {
                $topUsers = User::with(['mosque', 'mosque.endAssessment'])
                    ->whereHas('mosque', function ($q) use ($area, $mosque) {
                        $q->where('category_area_id', $area->id)->where('category_mosque_id', $mosque->id);
                    })->take(3)->get();

                $topUsers = $topUsers->map(function ($user) {
                    $totalValue = 0;

                    if ($user->mosque->endAssessment) {
                        $totalValue += $user->mosque->endAssessment->presentation_value;

                        if ($user->mosque->presentation && $user->mosque->presentation->startAssessment) {
                            $totalValue += $user->mosque->presentation->startAssessment->presentation_file;
                        }

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

        return view('admin.pages.assessment.end-assessment', compact('endAssessmentTheadNames', 'startAssessmentTheadNames', 'categoryTheadNames', 'juries', 'combinedData', 'categoryAreaId', 'categoryMosqueId', 'juryId', 'search', 'endAssessmentAllUsers', 'usersInStartAssessment', 'categories'));
    }

    public function edit(User $user)
    {
        return view('admin.pages.assessment.end-assessment-edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'presentation_value' => 'required|in:1,3,7,9',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user->mosque->endAssessment()->updateOrCreate(
                ['mosque_id' => $user->mosque->id],
                [
                    'jury_id' => Auth::id(),
                    'presentation_value' => $request->presentation_value,
                ]
            );

            return redirect(route('end_assessment.index'))->with('success', 'Nilai akhir berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    // Kebutuhan Method Index
    private function getTheadName(array $labels)
    {
        $thead = [];

        foreach ($labels as $label) {
            $thead[] = ['class' => 'text-center py-3', 'label' => $label];
        }

        return $thead;
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
