<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Timeline;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Distribution;
use App\Mail\AccountRegistration;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
            ['class' => 'text-center py-3', 'label' => 'Status Menilai'],
            ['class' => 'text-center py-3', 'label' => 'Tanggal Bergabung'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $theadNametwo = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama Panitia'],
            ['class' => 'text-center py-3', 'label' => 'Jumlah Peserta'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $timeline = Timeline::latest()->first();
        $startSelection = Carbon::parse($timeline->start_selection)->toDateString();
        $currentDate = Carbon::now()->setTimezone('Asia/Jakarta')->toDateString();

        $search = $request->input('pencarian');
        $query = User::query()->where('role', 'admin');

        $distributions = $query->clone()
            ->with('distributionToCommitte')
            ->has('distributionToCommitte')
            ->orderBy('updated_at', 'desc')
            ->latest('created_at')
            ->paginate(10);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhereRaw('LOWER(phone_number) LIKE ?', ['%' . strtolower($search) . '%']);
            });
        }

        $committees = $query->clone()->orderBy('updated_at', 'desc')->latest('created_at')->paginate(10);

        return view('admin.pages.committee.index', compact('theadNameOne', 'theadNametwo', 'startSelection', 'currentDate', 'search', 'committees', 'distributions'));
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
        Distribution::truncate();

        $users = User::where('role', 'user')->get();
        $admins = User::where('role', 'admin')
            ->where('is_committe_assessment', 'yes')
            ->where(function ($query) {
                $query->where('email', '!=', 'developer@gmail.com')
                    ->where('name', '!=', 'Developer');
            })->get();

        if ($admins->isEmpty()) {
            return redirect()->back()->with('error_distribution', 'Tidak ada panitia yang tersedia untuk pembagian penilaian.');
        }

        $totalAdmins = $admins->count();
        $totalUsers = $users->count();

        $usersPerAdmin = intdiv($totalUsers, $totalAdmins);
        $extraUsers = $totalUsers % $totalAdmins;

        $adminIndex = 0;

        foreach ($users as $index => $user) {
            $admin = $admins[$adminIndex];

            Distribution::create([
                'user_id' => $user->id,
                'committe_id' => $admin->id
            ]);

            $assignedUsers = Distribution::where('committe_id', $admin->id)->count();

            if ($assignedUsers >= $usersPerAdmin + ($adminIndex < $extraUsers ? 1 : 0)) {
                $adminIndex++;
            }
        }

        return redirect()->back()->with('success_distribution', 'Pembagian penilaian berhasil');
    }

    public function show(User $committee)
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-center py-3', 'label' => 'Logo'],
            ['class' => 'text-center py-3', 'label' => 'Kategori'],
            ['class' => 'text-center py-3', 'label' => 'Kategori Area'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
        ];

        $userIds = $committee->distributionToCommitte->pluck('user_id');
        $users = User::whereIn('id', $userIds)->get();

        return view('admin.pages.committee.show', compact('committee', 'theadName', 'users'));
    }

    public function edit(User $committee, $name)
    {
        if ($name === "edit") {
            return view('admin.pages.committee.edit', compact('committee'));
        } elseif ($name === "edit-pembagian-penilaian") {
            return view('admin.pages.committee.edit-distribution', compact('committee'));
        } else {
            abort(404);
        }
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
            $isCommitteAssessment = $request->input('is_committe_assessment');

            $committee->update([
                'name' => $request->input('name'),
                'phone_number' => $request->input('phone_number'),
                'email' => $request->input('email'),
                'is_committe_assessment' => $isCommitteAssessment,
            ]);

            return redirect(route('committee.index'))->with('success', 'Panitia berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui panitia: ' . $e->getMessage());
        }
    }

    public function updateDistribution(Request $request, User $committee)
    {
        //
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
