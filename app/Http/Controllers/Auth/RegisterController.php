<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\CategoryArea;
use App\Http\Controllers\Controller;
use App\Models\BusinessLine;
use App\Models\Company;
use App\Models\Mosque;
use App\Models\ParentCompany;
use App\Models\Province;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register()
    {
        $categoryAreas = CategoryArea::all();
        $companies = Company::all();
        $parentCompanies = ParentCompany::all();
        $businessLines = BusinessLine::all();
        $provinces = Province::all();

        return view('auth.register', compact('categoryAreas', 'companies', 'parentCompanies', 'businessLines', 'provinces'));
    }

    public function registerAct(Request $request)
    {
        // Validation
        $rules = [
            'name' => 'required|string',
            'position' => 'required|string',
            'phone_number' => 'required|numeric|unique:users,phone_number',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'category_area_id' => 'required|exists:category_areas,id',
            'name_mosque' => 'required|string',
            'capacity' => 'required|numeric',
            'leader' => 'required|string',
            'company_id' => 'required',
            'parent_company_id' => 'required',
            'business_line_id' => 'required|exists:business_lines,id',
            'address' => 'required|string',
            'city' => 'required|string',
            'province_id' => 'required|exists:provinces,id',
        ];

        if ($request->input('company_id') === 'another') {
            $rules['otherCompany'] = 'required|string|unique:companies,name';
        }

        if ($request->input('parent_company_id') === 'another') {
            $rules['otherParentCompany'] = 'required|string|unique:parent_companies,name';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // User
        $user = User::create([
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Company
        $parent_company_id = $request->input('parent_company_id');
        $company_id = $request->input('company_id');

        if ($request->input('parent_company_id') === 'another') {
            $newParentCompany = ParentCompany::create([
                'name' => $request->input('otherParentCompany'),
            ]);

            $parent_company_id = $newParentCompany->id;
        }

        if ($request->input('company_id') === 'another') {
            $newCompany = Company::create([
                'name' => $request->input('otherCompany'),
                'parent_company_id' => $parent_company_id,
                'business_line_id' => $request->input('business_line_id'),
            ]);

            $company_id = $newCompany->id;
        }

        // Mosque
        Mosque::create([
            'user_id' => $user->id,
            'category_area_id' => $request->input('category_area_id'),
            'name' => $request->input('name_mosque'),
            'capacity' => $request->input('capacity'),
            'leader' => $request->input('leader'),
            'company_id' => $company_id,
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'province_id' => $request->input('province_id'),
        ]);

        return redirect(route('login'))->with('success', 'Registrasi berhasil. Anda sekarang dapat masuk');
    }
}
