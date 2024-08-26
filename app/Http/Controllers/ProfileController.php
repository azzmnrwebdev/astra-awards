<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile()
    {
        $userLogin = Auth::user();

        return view('pages.profile.index', compact('userLogin'));
    }

    public function updateProfile(Request $request)
    {
        $userLogin = Auth::user();

        $rules = [
            'name' => 'required|string',
            'position' => 'required|string',
            'email' => 'required|string|unique:users,email,' . $userLogin->id,
            'phone_number' => 'required|numeric|unique:users,phone_number,' . $userLogin->id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $userLogin->update([
                'name' => $request->input('name'),
                'position' => $request->input('position'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
            ]);

            return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        $userLogin = Auth::user();

        $rules = [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!password_verify($request->input('current_password'), $userLogin->password)) {
            return redirect()->back()->with('error', 'Kata sandi saat ini salah.');
        }

        try {
            $userLogin->update([
                'password' => Hash::make($request->input('new_password')),
            ]);

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('success', 'Kata sandi berhasil diubah. Silahkan login kembali.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }
}
