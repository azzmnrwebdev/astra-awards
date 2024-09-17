<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\CategoryArea;
use App\Http\Controllers\Controller;
use App\Models\BusinessLine;
use App\Models\CategoryMosque;
use App\Models\Company;
use App\Models\Mosque;
use App\Models\ParentCompany;
use App\Models\Province;
use App\Models\Timeline;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register()
    {
        $timeline = Timeline::latest()->first();
        $categoryAreas = CategoryArea::all();
        $categoryMosques = CategoryMosque::all();
        $parentCompanies = ParentCompany::orderBy('name', 'asc')->get();
        $businessLines = BusinessLine::all();
        $provinces = Province::all();

        return view('auth.register', compact('timeline', 'categoryAreas', 'categoryMosques', 'parentCompanies', 'businessLines', 'provinces'));
    }

    public function registerAct(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'position' => 'required|string',
            'phone_number' => 'required|digits_between:10,13|unique:users,phone_number',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'category_area_id' => 'required|exists:category_areas,id',
            'category_mosque_id' => 'required|exists:category_mosques,id',
            'name_mosque' => 'required|string',
            'capacity' => 'required|numeric',
            'logo' => 'required',
            'logo.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'leader' => 'required|string',
            'leader_phone' => 'required|digits_between:10,13|unique:mosques,leader_phone',
            'leader_email' => 'required|email|unique:mosques,leader_email',
            'company_id' => 'required|exists:companies,id',
            'parent_company_id' => 'required|exists:parent_companies,id',
            'business_line_id' => 'required|exists:business_lines,id',
            'address' => 'required|string',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
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
                'role' => 'user',
                'status' => 0,
            ]);

            $fileName = 'logo' . '_' . sha1(mt_rand(1, 999999) . microtime()) . '.' . $request->file('logo')->getClientOriginalExtension();
            $filePath = $request->file('logo')->storeAs('logo', $fileName, 'public');

            Mosque::create([
                'user_id' => $user->id,
                'position' => $request->input('position'),
                'category_area_id' => $request->input('category_area_id'),
                'category_mosque_id' => $request->input('category_mosque_id'),
                'name' => $request->input('name_mosque'),
                'capacity' => $request->input('capacity'),
                'logo' => $filePath,
                'leader' => $request->input('leader'),
                'leader_phone' => $request->input('leader_phone'),
                'leader_email' => $request->input('leader_email'),
                'company_id' => $request->input('company_id'),
                'address' => $request->input('address'),
                'city_id' => $request->input('city_id'),
            ]);

            DB::commit();

            return redirect(route('login'))->with('success', 'Pendaftaran berhasil. Anda sekarang dapat masuk');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect(route('login'))->with('error', 'Pendaftaran gagal. Silakan coba lagi');
        }
    }
}
