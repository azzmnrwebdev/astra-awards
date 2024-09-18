<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ParentCompany;
use Exception;
use Illuminate\Support\Facades\Validator;

class ParentCompanyController extends Controller
{
    public function index(Request $request)
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $query = ParentCompany::query();
        $search = $request->input('search');

        if (!empty($search)) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        $parentCompanies = $query->orderByDesc('updated_at')->latest('created_at')->paginate(10);

        return view('admin.pages.parent_company.index', compact('theadName', 'search', 'parentCompanies'));
    }

    public function create()
    {
        return view('admin.pages.parent_company.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|unique:parent_companies,name',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            ParentCompany::create([
                'name' => $request->input('name'),
            ]);

            return redirect(route('parent_company.index'))->with('success', 'Induk perusahaan baru berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit(ParentCompany $parentCompany)
    {
        return view('admin.pages.parent_company.edit', compact('parentCompany'));
    }

    public function update(Request $request, ParentCompany $parentCompany)
    {
        $rules = [
            'name' => 'required|string|unique:parent_companies,name,' . $parentCompany->id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $parentCompany->update([
                'name' => $request->input('name'),
            ]);

            return redirect(route('parent_company.index'))->with('success', 'Induk perusahaan lama berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function destroy(ParentCompany $parentCompany)
    {
        if ($parentCompany->company()->exists()) {
            return redirect()->back()->with('error', 'Induk perusahaan sedang digunakan dalam data perusahaan dan tidak dapat dihapus');
        } else {
            $parentCompany->delete();
            return redirect()->back()->with('success', 'Induk perusahaan berhasil dihapus');
        }
    }
}
