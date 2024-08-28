<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginAct(Request $request)
    {
        // Validation
        $rules = [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $checkUser = User::where('email', $request->input('email'))->first();

            if ($checkUser->role === "admin") {
                return redirect(route('dashboard'));
            } else {
                return redirect(route('information'));
            }
        } else {
            return redirect()->back()->with('error', 'Email atau kata sandi Anda salah');
        }
    }
}
