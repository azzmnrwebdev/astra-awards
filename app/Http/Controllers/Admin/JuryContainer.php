<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AccountRegistration;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class JuryContainer extends Controller
{
    public function index(Request $request)
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama'],
            ['class' => 'text-start py-3', 'label' => 'Email'],
            ['class' => 'text-center py-3', 'label' => 'Nomor Ponsel'],
            ['class' => 'text-center py-3', 'label' => 'Status'],
            ['class' => 'text-center py-3', 'label' => 'Tanggal Bergabung'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $search = $request->input('search');
        $query = User::query()->where('role', 'jury');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhereRaw('LOWER(phone_number) LIKE ?', ['%' . strtolower($search) . '%']);
            });
        }

        $juries = $query->orderByDesc('updated_at')->latest('created_at')->paginate(10);

        return view('admin.pages.jury.index', compact('theadName', 'search', 'juries'));
    }

    public function create()
    {
        return view('admin.pages.jury.create');
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
                'role' => 'jury',
                'status' => 1,
            ]);

            $user->remember_token = Str::random(60);
            $user->save();

            Mail::to($user->email)->send(new AccountRegistration($user));

            DB::commit();

            return redirect(route('jury.index'))->with('success', 'Juri baru berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan juri: ' . $e->getMessage());
        }
    }

    public function edit(User $jury)
    {
        return view('admin.pages.jury.edit', compact('jury'));
    }

    public function update(Request $request, User $jury)
    {
        $rules = [
            'name' => 'required|string',
            'phone_number' => 'nullable|numeric|unique:users,phone_number,' . $jury->id,
            'email' => 'required|string|email|unique:users,email,' . $jury->id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $jury->update([
                'name' => $request->input('name'),
                'phone_number' => $request->input('phone_number'),
                'email' => $request->input('email'),
            ]);

            return redirect(route('jury.index'))->with('success', 'Juri berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui juri: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, User $jury)
    {
        if ($request->input('name_confirmation') !== $jury->name) {
            return redirect()->back()->with('error', 'Nama yang dikonfirmasi tidak cocok dengan nama juri');
        }

        try {
            $jury->delete();

            return redirect()->back()->with('success', 'Juri berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus juri: ' . $e->getMessage());
        }
    }
}
