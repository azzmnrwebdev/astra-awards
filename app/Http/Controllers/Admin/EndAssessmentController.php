<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryArea;
use App\Models\CategoryMosque;
use App\Models\User;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;

class EndAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-center py-3', 'label' => 'Kategori'],
            ['class' => 'text-center py-3', 'label' => 'Kategori Area'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
            ['class' => 'text-center py-3', 'label' => 'Total Nilai'],
        ];

        $otherTheadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-center py-3', 'label' => 'Kategori'],
            ['class' => 'text-center py-3', 'label' => 'Kategori Area'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $categoryTheadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
            ['class' => 'text-center py-3', 'label' => 'Total Nilai'],
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

        $search = $request->input('pencarian');

        // Menampilkan semua data pengguna penilaian akhir
        $allUsersInEndAssessment = collect();

        $categoryAreaId = $request->input('kategori_area');
        $categoryMosqueId = $request->input('kategori_masjid');

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

                    if ($user->mosque->endAssessment) {
                        $totalValue += $user->mosque->endAssessment->presentation_value;
                    }

                    if ($user->mosque->presentation && $user->mosque->presentation->startAssessment) {
                        $totalValue += $user->mosque->presentation->startAssessment->presentation_file;
                    }

                    $user->totalNilai = $totalValue + $user->mosque->total_pillar_value;
                    return $user;
                })->filter(function ($user) {
                    return $user->totalNilai > 0;
                });

                $topUsers = $users->sortByDesc('totalNilai');
                $allUsersInEndAssessment = $allUsersInEndAssessment->merge($topUsers);
            }
        }

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $usersInEndAssessment = new LengthAwarePaginator(
            $allUsersInEndAssessment->forPage($currentPage, $perPage),
            $allUsersInEndAssessment->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // Menampilkan semua data pengguna penilaian awal
        $allUsersInStartAssessment = collect();

        foreach ($categoryAreas as $area) {
            foreach ($categoryMosques as $mosque) {
                $users = User::with([
                    'mosque',
                    'mosque.company',
                    'mosque.presentation.startAssessment'
                ])->whereHas('mosque', function ($q) use ($area, $mosque) {
                    $q->where('category_area_id', $area->id)->where('category_mosque_id', $mosque->id);
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

                    if ($user->mosque->presentation && $user->mosque->presentation->startAssessment) {
                        $totalValue += $user->mosque->presentation->startAssessment->presentation_file;
                    }

                    $user->totalNilai = $totalValue + $user->mosque->total_pillar_value;

                    return $user;
                })->filter(function ($user) {
                    return $user->totalNilai > 0;
                });

                $topUsers = $users->sortByDesc('totalNilai');
                $allUsersInStartAssessment = $allUsersInStartAssessment->merge($topUsers);
            }
        }

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $usersInStartAssessment = new LengthAwarePaginator(
            $allUsersInStartAssessment->forPage($currentPage, $perPage),
            $allUsersInStartAssessment->count(),
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

        return view('admin.pages.assessment.end-assessment', compact('theadName', 'otherTheadName', 'categoryTheadName', 'combinedData', 'categoryAreaId', 'categoryMosqueId', 'search', 'usersInEndAssessment', 'usersInStartAssessment', 'categories'));
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
                ['presentation_value' => $request->presentation_value]
            );

            return redirect(route('end_assessment.index'))->with('success', 'Nilai akhir berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }
}
