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
                ['class' => 'text-center py-3', 'label' => 'Rata Rata'],
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
                ['class' => 'text-center py-3', 'label' => 'Total Nilai<br />Keseluruhan Juri'],
                ['class' => 'text-center py-3', 'label' => 'Rata Rata'],
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
        $year = $request->input('tahun', date('Y'));
        $search = $request->input('pencarian');

        // Menampilkan semua data pengguna
        $allUsers = collect();

        foreach ($categoryAreas as $area) {
            foreach ($categoryMosques as $mosque) {
                $users = User::with([
                    'mosque',
                    'mosque.company',
                    'mosque.presentationWithCustomYear' => fn($query) => $query->where('year', $year),
                    'mosque.presentationWithCustomYear.startAssessmentWithCustomYear' => fn($query) => $query->where('year', $year),
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
                })->where(function ($q) {
                    $q->whereHas('mosque.presentationWithCustomYear');
                })->when($categoryAreaId && $categoryMosqueId, function ($query) use ($categoryAreaId, $categoryMosqueId) {
                    $query->whereHas('mosque', function ($q) use ($categoryAreaId, $categoryMosqueId) {
                        $q->where('category_area_id', $categoryAreaId)
                            ->where('category_mosque_id', $categoryMosqueId);
                    });
                })->when($juryId, function ($query) use ($juryId) {
                    $query->where(function ($q) use ($juryId) {
                        $q->whereHas('mosque.presentationWithCustomYear.startAssessmentWithCustomYear', function ($q2) use ($juryId) {
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

                $allUsers = $allUsers->merge($users->sortByDesc('totalNilai')->take(5));
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
                    'mosque.presentationWithCustomYear' => fn($query) => $query->where('year', $year),
                    'mosque.presentationWithCustomYear.startAssessmentWithCustomYear' => fn($query) => $query->where('year', $year),
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

                    $presentation = $user->mosque->presentationWithCustomYear;

                    if ($presentation && $presentation->startAssessmentWithCustomYear->isNotEmpty()) {
                        $totalPillarOne = $presentation->startAssessmentWithCustomYear->sum('presentation_file_pillar_one');
                        $totalPillarTwo = $presentation->startAssessmentWithCustomYear->sum('presentation_file_pillar_two');
                        $totalPillarThree = $presentation->startAssessmentWithCustomYear->sum('presentation_file_pillar_three');
                        $totalPillarFour = $presentation->startAssessmentWithCustomYear->sum('presentation_file_pillar_four');
                        $totalPillarFive = $presentation->startAssessmentWithCustomYear->sum('presentation_file_pillar_five');

                        $totalValue += $totalPillarOne * $weightPillarOne;
                        $totalValue += $totalPillarTwo * $weightPillarTwo;
                        $totalValue += $totalPillarThree * $weightPillarThree;
                        $totalValue += $totalPillarFour * $weightPillarFour;
                        $totalValue += $totalPillarFive * $weightPillarFive;

                        $juryCount = $presentation->startAssessmentWithCustomYear->count();

                        if ($juryCount > 0) {
                            $totalValue = $totalValue / $juryCount;
                        }
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

    public function show(User $user, Request $request)
    {
        $year = $request->input('tahun', date('Y'));

        $user->load([
            'mosque.presentationWithCustomYear' => fn($query) => $query->where('year', $year),
            'mosque.presentationWithCustomYear.startAssessmentWithCustomYear' => fn($query) => $query->where('year', $year),
        ]);

        return view('admin.pages.assessment.start-assessment-show', compact('user'));
    }

    // Kebutuhan Method Index
    private function getCategoryTheadName()
    {
        return [
            ['class' => 'text-center py-3', 'label' => 'Peringkat'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'PIC'],
            ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
            ['class' => 'text-center py-3', 'label' => 'Provinsi'],
            ['class' => 'text-center py-3', 'label' => 'Rata Rata'],
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
