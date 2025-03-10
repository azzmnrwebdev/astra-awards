<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BusinessLine;
use App\Models\Company;
use App\Models\ParentCompany;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama'],
            ['class' => 'text-start py-3', 'label' => 'Induk Perusahaan'],
            ['class' => 'text-start py-3', 'label' => 'Lini Bisnis'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $businessLines = BusinessLine::all();
        $parentCompanies = ParentCompany::all();

        $search = $request->input('pencarian');
        $businessLineId = $request->input('lini_bisnis');
        $parentCompanyId = $request->input('induk_perusahaan');
        $query = Company::with(['parentCompany', 'businessLine', 'mosque']);

        if ($businessLineId) {
            $query->where('business_line_id', $businessLineId);
        }

        if ($parentCompanyId) {
            $query->where('parent_company_id', $parentCompanyId);
        }

        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        $companies = $query->orderByDesc('updated_at')->latest('created_at')->paginate(10);

        return view('admin.pages.company.index', compact('theadName', 'search', 'businessLineId', 'parentCompanyId', 'parentCompanies', 'businessLines', 'companies'));
    }

    public function create()
    {
        $parentCompanies = ParentCompany::all();
        $businessLines = BusinessLine::all();

        return view('admin.pages.company.create', compact('parentCompanies', 'businessLines'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|unique:companies,name',
            'parent_company_id' => 'required',
            'business_line_id' => 'required',
        ];

        if ($request->input('parent_company_id') === 'another') {
            $rules['otherParentCompany'] = 'required|string|unique:parent_companies,name';
        }

        if ($request->input('business_line_id') === 'another') {
            $rules['otherBusinessLine'] = 'required|string|unique:business_lines,name';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $parent_company_id = $request->input('parent_company_id');
            $business_line_id = $request->input('business_line_id');

            if ($request->input('parent_company_id') === 'another') {
                $newParentCompany = ParentCompany::create([
                    'name' => $request->input('otherParentCompany'),
                ]);

                $parent_company_id = $newParentCompany->id;
            }

            if ($request->input('business_line_id') === 'another') {
                $newBusinessLine = BusinessLine::create([
                    'name' => $request->input('otherBusinessLine'),
                ]);

                $business_line_id = $newBusinessLine->id;
            }

            Company::create([
                'name' => $request->input('name'),
                'parent_company_id' => $parent_company_id,
                'business_line_id' => $business_line_id,
            ]);

            DB::commit();

            return redirect(route('company.index'))->with('success', 'Perusahaan baru berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit(Company $company)
    {
        $parentCompanies = ParentCompany::all();
        $businessLines = BusinessLine::all();

        return view('admin.pages.company.edit', compact('company', 'parentCompanies', 'businessLines'));
    }

    public function update(Request $request, Company $company)
    {
        $rules = [
            'name' => 'required|string|unique:companies,name,' . $company->id,
            'parent_company_id' => 'required',
            'business_line_id' => 'required',
        ];

        if ($request->input('parent_company_id') === 'another') {
            $rules['otherParentCompany'] = 'required|string|unique:parent_companies,name';
        }

        if ($request->input('business_line_id') === 'another') {
            $rules['otherBusinessLine'] = 'required|string|unique:business_lines,name';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $parent_company_id = $request->input('parent_company_id');
            $business_line_id = $request->input('business_line_id');

            if ($request->input('parent_company_id') === 'another') {
                $newParentCompany = ParentCompany::create([
                    'name' => $request->input('otherParentCompany'),
                ]);

                $parent_company_id = $newParentCompany->id;
            }

            if ($request->input('business_line_id') === 'another') {
                $newBusinessLine = BusinessLine::create([
                    'name' => $request->input('otherBusinessLine'),
                ]);

                $business_line_id = $newBusinessLine->id;
            }

            $company->update([
                'name' => $request->input('name'),
                'parent_company_id' => $parent_company_id,
                'business_line_id' => $business_line_id,
            ]);

            DB::commit();

            return redirect(route('company.index'))->with('success', 'Perusahaan lama berhasil diperbarui');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(Company $company)
    {
        if ($company->mosque()->exists()) {
            return redirect()->back()->with('error', 'Perusahaan sedang digunakan dalam data masjid dan tidak dapat dihapus');
        } else {
            $company->delete();
            return redirect()->back()->with('success', 'Perusahaan berhasil dihapus');
        }
    }
}
