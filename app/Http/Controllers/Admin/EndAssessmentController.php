<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\CategoryArea;
use Illuminate\Http\Request;
use App\Models\CategoryMosque;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\EndAssessment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class EndAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $categoryAreas = CategoryArea::all();
        $categoryMosques = CategoryMosque::all();
        $juries = User::where('role', 'jury')->get();

        if ($user->role == 'admin') {
            $endAssessmentTheadNames = $this->getTheadName([
                'No',
                'Kategori',
                'Kategori Area',
                'Nama Masjid/Musala',
                'Perusahaan',
                'Total Nilai',
                'Rata Rata',
                'Aksi',
            ]);
        } else {
            $endAssessmentTheadNames = $this->getTheadName([
                'No',
                'Kategori',
                'Kategori Area',
                'Nama Masjid/Musala',
                'Perusahaan',
                'Total Nilai<br />Per Juri',
                'Total Nilai<br />Keseluruhan Juri',
                'Rata Rata',
                'Aksi',
            ]);
        }

        $startAssessmentTheadNames = $this->getTheadName([
            'No',
            'Kategori',
            'Kategori Area',
            'Nama Masjid/Musala',
            'Perusahaan',
            'Status',
            'Aksi',
        ]);

        $categoryTheadNames = $this->getTheadName([
            'No',
            'Nama Masjid/Musala',
            'Perusahaan',
            'Provinsi',
            'Rata Rata',
            'Aksi',
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

                    $weightPillarOne = 0.25;
                    $weightPillarTwo = 0.25;
                    $weightPillarThree = 0.20;
                    $weightPillarFour = 0.15;
                    $weightPillarFive = 0.15;

                    if ($user->mosque->endAssessment->isNotEmpty()) {
                        $totalPillarOne = $user->mosque->endAssessment->sum('presentation_value_pillar_one');
                        $totalPillarTwo = $user->mosque->endAssessment->sum('presentation_value_pillar_two');
                        $totalPillarThree = $user->mosque->endAssessment->sum('presentation_value_pillar_three');
                        $totalPillarFour = $user->mosque->endAssessment->sum('presentation_value_pillar_four');
                        $totalPillarFive = $user->mosque->endAssessment->sum('presentation_value_pillar_five');

                        $totalValue += $totalPillarOne * $weightPillarOne;
                        $totalValue += $totalPillarTwo * $weightPillarTwo;
                        $totalValue += $totalPillarThree * $weightPillarThree;
                        $totalValue += $totalPillarFour * $weightPillarFour;
                        $totalValue += $totalPillarFive * $weightPillarFive;

                        $juryCount = $user->mosque->endAssessment->count();

                        if ($juryCount > 0) {
                            $totalValue = $totalValue / $juryCount;
                        }
                    }

                    $user->totalNilai = $totalValue;

                    return $user;
                })->filter(function ($user) {
                    return $user->totalNilai > 0;
                });

                $endAssessmentUsers = $endAssessmentUsers->merge($users->sortByDesc('totalNilai'));
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

                        $juryCount = $user->mosque->presentation->startAssessment->count();

                        if ($juryCount > 0) {
                            $totalValue = $totalValue / $juryCount;
                        }
                    }

                    $user->totalNilai = $totalValue;

                    return $user;
                })->filter(function ($user) {
                    return $user->totalNilai > 0;
                });

                $topUsers = $users->sortByDesc('totalNilai')->take(3);

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
                    })->get();

                $topUsers = $topUsers->map(function ($user) {
                    $totalValue = 0;

                    $weightPillarOne = 0.25;
                    $weightPillarTwo = 0.25;
                    $weightPillarThree = 0.20;
                    $weightPillarFour = 0.15;
                    $weightPillarFive = 0.15;

                    if ($user->mosque->endAssessment->isNotEmpty()) {
                        $totalPillarOne = $user->mosque->endAssessment->sum('presentation_value_pillar_one');
                        $totalPillarTwo = $user->mosque->endAssessment->sum('presentation_value_pillar_two');
                        $totalPillarThree = $user->mosque->endAssessment->sum('presentation_value_pillar_three');
                        $totalPillarFour = $user->mosque->endAssessment->sum('presentation_value_pillar_four');
                        $totalPillarFive = $user->mosque->endAssessment->sum('presentation_value_pillar_five');

                        $totalValue += $totalPillarOne * $weightPillarOne;
                        $totalValue += $totalPillarTwo * $weightPillarTwo;
                        $totalValue += $totalPillarThree * $weightPillarThree;
                        $totalValue += $totalPillarFour * $weightPillarFour;
                        $totalValue += $totalPillarFive * $weightPillarFive;

                        $juryCount = $user->mosque->endAssessment->count();

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

        return view('admin.pages.assessment.end-assessment', compact('endAssessmentTheadNames', 'startAssessmentTheadNames', 'categoryTheadNames', 'juries', 'combinedData', 'categoryAreaId', 'categoryMosqueId', 'juryId', 'search', 'endAssessmentAllUsers', 'usersInStartAssessment', 'categories'));
    }

    public function show(User $user)
    {
        return view('admin.pages.assessment.end-assessment-show', compact('user'));
    }

    public function edit(User $user)
    {
        $juryId = Auth::user()->id;
        $endAssessment = EndAssessment::where('mosque_id', $user->mosque->id)->where('jury_id', $juryId)->first();

        return view('admin.pages.assessment.end-assessment-edit', compact('user', 'endAssessment'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'presentation_value_pillar_one' => 'required',
            'presentation_value_pillar_two' => 'required',
            'presentation_value_pillar_three' => 'required',
            'presentation_value_pillar_four' => 'required',
            'presentation_value_pillar_five' => 'required',
        ];

        $messages = [
            'presentation_value_pillar_two.required' => 'Nilai untuk pilar 1 tidak boleh kosong.',
            'presentation_value_pillar_one.required' => 'Nilai untuk pilar 2 tidak boleh kosong.',
            'presentation_value_pillar_three.required' => 'Nilai untuk pilar 3 tidak boleh kosong.',
            'presentation_value_pillar_four.required' => 'Nilai untuk pilar 4 tidak boleh kosong.',
            'presentation_value_pillar_five.required' => 'Nilai untuk pilar 5 tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $id = $request->input('id');

            EndAssessment::updateOrCreate(
                ['id' => $id],
                [
                    'mosque_id' => $request->input('mosque_id'),
                    'jury_id' => Auth::id(),
                    'presentation_value_pillar_one' => $request->input('presentation_value_pillar_one'),
                    'presentation_value_pillar_two' => $request->input('presentation_value_pillar_two'),
                    'presentation_value_pillar_three' => $request->input('presentation_value_pillar_three'),
                    'presentation_value_pillar_four' => $request->input('presentation_value_pillar_four'),
                    'presentation_value_pillar_five' => $request->input('presentation_value_pillar_five')
                ]
            );

            $message = $id ? 'Penilaian Akhir berhasil diperbarui.' : 'Penilaian Akhir berhasil disimpan.';

            return redirect(route('end_assessment.index'))->with('success', $message);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan pada server.');
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
