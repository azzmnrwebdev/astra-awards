<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPassword;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function forgotPasswordAct(Request $request)
    {
        $rules = [
            'email' => 'required|string|email',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->input('email'))->first();

        if (empty($user)) {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }

        $user->remember_token = Str::random(60);
        $user->save();

        Mail::to($user->email)->send(new ResetPassword($user));

        return redirect(route('login'))->with('success', 'Kami telah mengirimkan email reset password ke alamat email anda');
    }

    public function resetPassword(Request $request, $token)
    {
        $userToken = User::where('remember_token', $token)->first();

        if (!$userToken) {
            return redirect(route('forgotPassword'))->with('error', 'Token tidak valid');
        }

        return view('auth.reset-password', compact('token'));
    }

    public function resetPasswordAct(Request $request)
    {
        $rules = [
            'password' => 'required|string|min:8',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $userToken = User::where('remember_token', $request->input('token'))->first();

        if (empty($userToken)) {
            return redirect(route('forgotPassword'))->with('error', 'Token tidak valid');
        }

        if (empty($userToken)) {
            return redirect(route('login'))->with('error', 'Email tidak ditemukan');
        }

        $userToken->password = Hash::make($request->input('password'));
        $userToken->remember_token = null;
        $userToken->save();

        return redirect(route('login'))->with('success', 'Password berhasil direset');
    }
}
