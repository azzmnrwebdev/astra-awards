<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        return view('pages.setting.index');
    }

    public function account()
    {
        $userLogin = Auth::user();

        return view('pages.setting.account', compact('userLogin'));
    }

    public function accountAct(Request $request)
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

        DB::beginTransaction();

        try {
            $userLogin->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
            ]);

            if ($userLogin->mosque) {
                $userLogin->mosque->update([
                    'position' => $request->input('position'),
                ]);
            }

            DB::commit();

            return redirect(route('setting.index'))->with('success', 'Profil berhasil diperbarui.');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect(route('setting.index'))->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    public function general()
    {
        $userLogin = Auth::user();

        if ($userLogin->mosque) {
            $mosque = $userLogin->mosque;
        }

        return view('pages.setting.general', compact('mosque'));
    }

    public function generalAct(Request $request)
    {
        //
    }

    public function changePassword()
    {
        return view('pages.setting.change-password');
    }

    public function changePasswordAct(Request $request)
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
            return redirect(route('setting.index'))->with('error', 'Kata sandi saat ini salah.');
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
            return redirect(route('setting.index'))->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }
}
