<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AccountRegistration;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CommitteeController extends Controller
{
    public function index()
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama'],
            ['class' => 'text-start py-3', 'label' => 'Email'],
            ['class' => 'text-center py-3', 'label' => 'Nomor Ponsel'],
            ['class' => 'text-center py-3', 'label' => 'Status'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $committees = User::where('role', 'admin')->orderByDesc('updated_at')->latest('created_at')->paginate(10);

        return view('admin.pages.committee.index', compact('theadName', 'committees'));
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

            return redirect(route('committee.index'))->with('success', 'Panitia baru berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan panitia: ' . $e->getMessage());
        }
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
