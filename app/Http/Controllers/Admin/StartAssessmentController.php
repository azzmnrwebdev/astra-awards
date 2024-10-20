<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CategoryArea;
use Illuminate\Http\Request;
use App\Models\CategoryMosque;
use App\Models\StartAssessment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class StartAssessmentController extends Controller
{
    public function presentationAssessmentAct(Request $request)
    {
        $rules = [
            'presentation_file_pillar_two' => 'required',
            'presentation_file_pillar_one' => 'required',
            'presentation_file_pillar_three' => 'required',
            'presentation_file_pillar_four' => 'required',
            'presentation_file_pillar_five' => 'required',
        ];

        $messages = [
            'presentation_file_pillar_two.required' => 'Nilai untuk pilar 1 tidak boleh kosong.',
            'presentation_file_pillar_one.required' => 'Nilai untuk pilar 2 tidak boleh kosong.',
            'presentation_file_pillar_three.required' => 'Nilai untuk pilar 3 tidak boleh kosong.',
            'presentation_file_pillar_four.required' => 'Nilai untuk pilar 4 tidak boleh kosong.',
            'presentation_file_pillar_five.required' => 'Nilai untuk pilar 5 tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        StartAssessment::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'presentation_id' => $request->input('presentation_id'),
                'jury_id' => Auth::id(),
                'presentation_file_pillar_two' => $request->input('presentation_file_pillar_two'),
                'presentation_file_pillar_one' => $request->input('presentation_file_pillar_one'),
                'presentation_file_pillar_three' => $request->input('presentation_file_pillar_three'),
                'presentation_file_pillar_four' => $request->input('presentation_file_pillar_four'),
                'presentation_file_pillar_five' => $request->input('presentation_file_pillar_five')
            ]
        );

        return redirect()->back()->with('success', 'Nilai berhasil disimpan');
    }

    public function index(Request $request)
    {
        $categoryAreas = CategoryArea::all();
        $categoryMosques = CategoryMosque::all();
        $juries = User::where('role', 'jury')->get();

        $theadName = $this->getTheadName();
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

                    if ($user->mosque->presentation && $user->mosque->presentation->startAssessment) {
                        $totalValue += $user->mosque->presentation->startAssessment->presentation_file_pillar_one;
                        $totalValue += $user->mosque->presentation->startAssessment->presentation_file_pillar_two;
                        $totalValue += $user->mosque->presentation->startAssessment->presentation_file_pillar_three;
                        $totalValue += $user->mosque->presentation->startAssessment->presentation_file_pillar_four;
                        $totalValue += $user->mosque->presentation->startAssessment->presentation_file_pillar_five;
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
                        $totalValue += $user->mosque->presentation->startAssessment->presentation_file_pillar_one;
                        $totalValue += $user->mosque->presentation->startAssessment->presentation_file_pillar_two;
                        $totalValue += $user->mosque->presentation->startAssessment->presentation_file_pillar_three;
                        $totalValue += $user->mosque->presentation->startAssessment->presentation_file_pillar_four;
                        $totalValue += $user->mosque->presentation->startAssessment->presentation_file_pillar_five;
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

        return view('admin.pages.assessment.start-assessment', compact('juries', 'theadName', 'categoryTheadName', 'combinedData', 'categoryAreaId', 'categoryMosqueId', 'juryId', 'search', 'paginatedUsers', 'categories'));
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
