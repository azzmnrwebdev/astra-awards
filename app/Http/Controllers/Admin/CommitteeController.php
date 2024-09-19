<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AccountRegistration;
use App\Models\Distribution;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CommitteeController extends Controller
{
    public function index(Request $request)
    {
        $theadNameOne = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama'],
            ['class' => 'text-start py-3', 'label' => 'Email'],
            ['class' => 'text-center py-3', 'label' => 'Nomor Ponsel'],
            ['class' => 'text-center py-3', 'label' => 'Status'],
            ['class' => 'text-center py-3', 'label' => 'Tanggal Bergabung'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $theadNametwo = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama Panitia'],
            ['class' => 'text-center py-3', 'label' => 'Jumlah Peserta'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $search = $request->input('search');
        $query = User::query()->where('role', 'admin');

        $distributions = $query->clone()
            ->with('distributionToCommitte')
            ->has('distributionToCommitte')
            ->orderBy('updated_at', 'desc')
            ->latest('created_at')
            ->paginate(10);

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhereRaw('LOWER(phone_number) LIKE ?', ['%' . strtolower($search) . '%']);
            });
        }

        $committees = $query->clone()->orderBy('updated_at', 'desc')->latest('created_at')->paginate(10);

        return view('admin.pages.committee.index', compact('theadNameOne', 'theadNametwo', 'search', 'committees', 'distributions'));
    }

    public function create()
    {
        return view('admin.pages.committee.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'phone_number' => 'nullable|numeric|unique:users,phone_number',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->input('name'),
                'phone_number' => $request->input('phone_number'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => 'admin',
                'status' => 1,
            ]);

            $user->remember_token = Str::random(60);
            $user->save();

            Mail::to($user->email)->send(new AccountRegistration($user));

            DB::commit();

            return redirect(route('committee.index'))->with('success', 'Panitia baru berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan panitia: ' . $e->getMessage());
        }
    }

    public function distribution()
    {
        $users = User::where('role', 'user')->get();
        $admins = User::where('role', 'admin')->get();

        if ($admins->count() < 2) {
            return redirect()->back()->with('error_distribution', 'Jumlah admin minimal 2');
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

        return redirect()->back()->with('success_distribution', 'Pembagian penilaian berhasil');
    }

    public function show(User $committee)
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-center py-3', 'label' => 'Logo'],
            ['class' => 'text-start py-3', 'label' => 'Nama Peserta'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Kategori Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Kategori Area'],
        ];

        $userIds = $committee->distributionToCommitte->pluck('user_id');
        $users = User::whereIn('id', $userIds)->get();

        return view('admin.pages.committee.show', compact('committee', 'theadName', 'users'));
    }

    public function edit(User $committee)
    {
        return view('admin.pages.committee.edit', compact('committee'));
    }

    public function update(Request $request, User $committee)
    {
        $rules = [
            'name' => 'required|string',
            'phone_number' => 'nullable|numeric|unique:users,phone_number,' . $committee->id,
            'email' => 'required|string|email|unique:users,email,' . $committee->id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $committee->update([
                'name' => $request->input('name'),
                'phone_number' => $request->input('phone_number'),
                'email' => $request->input('email'),
            ]);

            return redirect(route('committee.index'))->with('success', 'Panitia berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui panitia: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, User $committee)
    {
        if ($request->input('name_confirmation') !== $committee->name) {
            return redirect()->back()->with('error', 'Nama yang dikonfirmasi tidak cocok dengan nama panitia');
        }

        try {
            $committee->delete();

            return redirect()->back()->with('success', 'Panitia berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus panitia: ' . $e->getMessage());
        }
    }
}
