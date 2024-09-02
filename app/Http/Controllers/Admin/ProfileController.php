<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('admin.pages.profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('admin.pages.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|numeric|unique:users,phone_number,' . $user->id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->update([
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
        ]);

        return redirect(route('dashboard_profile.index'))->with('success', 'Profil berhasil diperbarui');
    }

    public function editPassword()
    {
        return view('admin.pages.profile.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!password_verify($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('error', 'Password saat ini salah.');
        }

        $user->update([
            'password' => Hash::make($request->input('new_password')),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silahkan login kembali.');
    }
}
