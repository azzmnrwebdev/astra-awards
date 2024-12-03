<?php

namespace App\Http\Controllers;

use App\Models\BusinessLine;
use App\Models\CategoryArea;
use App\Models\CategoryMosque;
use App\Models\ParentCompany;
use App\Models\Province;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
            'email' => 'required|string|unique:users,email,' . $userLogin->id,
            'phone_number' => 'required|digits_between:10,13|unique:users,phone_number,' . $userLogin->id,
        ];

        if ($userLogin->hasRole('user')) {
            $rules['position'] = 'required|string';
        }

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

            return redirect(route('setting.index'))->with('success', 'Akun berhasil diperbarui.');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect(route('setting.index'))->with('error', 'Terjadi kesalahan saat memperbarui akun: ' . $e->getMessage());
        }
    }

    public function general()
    {
        $userLogin = Auth::user();

        if ($userLogin->mosque) {
            $mosque = $userLogin->mosque;
        }

        $categoryAreas = CategoryArea::all();
        $categoryMosques = CategoryMosque::all();
        $businessLines = BusinessLine::all();
        $parentCompanies = ParentCompany::orderBy('name', 'asc')->get();
        $provinces = Province::all();

        return view('pages.setting.general', compact('mosque', 'categoryAreas', 'categoryMosques', 'businessLines', 'parentCompanies', 'provinces'));
    }

    public function generalAct(Request $request)
    {
        $userLogin = Auth::user();

        $rules = [
            'category_area' => 'required|exists:category_areas,id',
            'category_mosque' => 'required|exists:category_mosques,id',
            'name' => 'required|string',
            'capacity' => 'required|numeric',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg',
            'leader' => 'required|string',
            'leader_phone' => 'required|digits_between:10,13|unique:mosques,leader_phone,' . $userLogin->mosque->id,
            'leader_email' => 'required|email|unique:mosques,leader_email,' . $userLogin->mosque->id,
            'business_line' => 'required|exists:business_lines,id',
            'parent_company' => 'required|exists:parent_companies,id',
            'company' => 'required|exists:companies,id',
            'address' => 'required|string',
            'province' => 'required|exists:provinces,id',
            'city' => 'required|exists:cities,id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $mosque = $userLogin->mosque;

            if ($request->hasFile('logo')) {
                if ($mosque->logo && Storage::exists('public/' . $mosque->logo)) {
                    Storage::delete('public/' . $mosque->logo);
                }

                $logo = $request->file('logo');
                $mosqueName = strtolower(preg_replace('/\s+/', '_', preg_replace('/\W+/', '', $request->input('name'))));
                $logoName = 'logo_' . $mosqueName . '_' . sha1(mt_rand(1, 999999) . microtime()) . '.' . $logo->getClientOriginalExtension();
                $logoPath = $logo->storeAs('logo', $logoName, 'public');

                $mosque->logo = $logoPath;
            }

            $mosque->update([
                'category_area_id' => $request->input('category_area'),
                'category_mosque_id' => $request->input('category_mosque'),
                'name' => $request->input('name'),
                'capacity' => $request->input('capacity'),
                'leader' => $request->input('leader'),
                'leader_phone' => $request->input('leader_phone'),
                'leader_email' => $request->input('leader_email'),
                'company_id' => $request->input('company'),
                'address' => $request->input('address'),
                'city_id' => $request->input('city'),
            ]);

            DB::commit();

            return redirect(route('setting.index'))->with('success', 'DKM berhasil diperbarui.');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect(route('setting.index'))->with('error', 'Terjadi kesalahan saat memperbarui dkm: ' . $e->getMessage());
        }
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
            return redirect(route('setting.index'))->with('error', 'Terjadi kesalahan saat memperbarui kata sandi: ' . $e->getMessage());
        }
    }
}
