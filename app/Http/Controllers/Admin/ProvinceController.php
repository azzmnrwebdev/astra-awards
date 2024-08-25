<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Province;
use Exception;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    public function index()
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $provinces = Province::orderByDesc('updated_at')->latest('created_at')->paginate(10);

        return view('admin.pages.province.index', compact('theadName', 'provinces'));
    }

    public function create()
    {
        return view('admin.pages.province.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string||unique:provinces,name',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            Province::create([
                'name' => $request->input('name'),
            ]);

            return redirect(route('province.index'))->with('success', 'Provinsi baru berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit(Province $province)
    {
        return view('admin.pages.province.edit', compact('province'));
    }

    public function update(Request $request, Province $province)
    {
        $rules = [
            'name' => 'required|string||unique:provinces,name,' . $province->id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $province->update([
                'name' => $request->input('name'),
            ]);

            return redirect(route('province.index'))->with('success', 'Provinsi lama berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function destroy(Province $province)
    {
        if ($province->mosque()->exists()) {
            return redirect()->back()->with('error', 'Provinsi sedang digunakan dalam data masjid dan tidak dapat dihapus');
        } else {
            $province->delete();
            return redirect()->back()->with('success', 'Provinsi berhasil dihapus');
        }
    }
}
