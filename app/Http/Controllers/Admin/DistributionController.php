<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Distribution;
use App\Http\Controllers\Controller;

class DistributionController extends Controller
{
    public function index()
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama Panitia'],
            ['class' => 'text-center py-3', 'label' => 'Jumlah DKM'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $committes = User::with(['distributionToCommitte'])
            ->where('role', 'admin')
            ->has('distributionToCommitte')
            ->orderByDesc('updated_at')
            ->latest('created_at')
            ->paginate(10);

        return view('admin.pages.distribution.index', compact('theadName', 'committes'));
    }

    public function store(Request $request)
    {
        $users = User::where('role', 'user')->get();
        $admins = User::where('role', 'admin')->get();

        if ($admins->count() < 2) {
            return redirect()->back()->with('error', 'Jumlah admin minimal 2');
        }

        foreach ($users as $user) {
            $randomAdmins = $admins->random(2);

            foreach ($randomAdmins as $admin) {
                $existingDistribution = Distribution::where('user_id', $user->id)
                    ->where('committe_id', $admin->id)
                    ->first();

                if (!$existingDistribution) {
                    Distribution::create([
                        'user_id' => $user->id,
                        'committe_id' => $admin->id
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function show(User $distribution)
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-center py-3', 'label' => 'Logo'],
            ['class' => 'text-start py-3', 'label' => 'Nama DKM'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Kategori Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Kategori Area'],
        ];

        $userIds = $distribution->distributionToCommitte->pluck('user_id');
        $users = User::whereIn('id', $userIds)->get();

        return view('admin.pages.distribution.show', compact('distribution', 'theadName', 'users'));
    }
}
