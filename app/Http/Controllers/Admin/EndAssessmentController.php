<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryArea;
use App\Models\CategoryMosque;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class EndAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $theadName = [
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

        // Menampilkan semua data pengguna penilaian akhir
        $allUsersInEndAssessment = collect();

        foreach ($categoryAreas as $area) {
            foreach ($categoryMosques as $mosque) {
                $users = User::with([
                    'mosque',
                    'mosque.company',
                    'mosque.endAssessment'
                ])->whereHas('mosque', function ($q) use ($area, $mosque) {
                    $q->where('category_area_id', $area->id)->where('category_mosque_id', $mosque->id);
                })->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->whereRaw('LOWER(users.name) LIKE ?', ['%' . strtolower($search) . '%'])
                            ->orWhereHas('mosque', function ($mosqueQuery) use ($search) {
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

                    $user->totalNilai = $totalValue;
                    return $user;
                })->filter(function ($user) {
                    return $user->totalNilai > 0;
                });

                $topUsers = $users->sortBy('totalNilai')->take(5);
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
                        $q->whereRaw('LOWER(users.name) LIKE ?', ['%' . strtolower($search) . '%'])
                            ->orWhereHas('mosque', function ($mosqueQuery) use ($search) {
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

                    $user->totalNilai = $totalValue;

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

        return view('admin.pages.assessment.end-assessment', compact('theadName', 'search', 'usersInEndAssessment', 'usersInStartAssessment'));
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }
}
