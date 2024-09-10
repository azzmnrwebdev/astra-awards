<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function index()
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama'],
            ['class' => 'text-start py-3', 'label' => 'Provinsi'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $cities = City::orderByDesc('updated_at')->latest('created_at')->paginate(10);

        return view('admin.pages.city.index', compact('theadName', 'cities'));
    }

    public function create()
    {
        $provinces = Province::all();

        return view('admin.pages.city.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|unique:cities,name',
            'province_id' => 'required|exists:provinces,id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            City::create([
                'province_id' => $request->input('province_id'),
                'name' => $request->input('name'),
            ]);

            return redirect(route('city.index'))->with('success', 'Kota/Kabupaten berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit(City $city)
    {
        $provinces = Province::all();

        return view('admin.pages.city.edit', compact('city', 'provinces'));
    }

    public function update(Request $request, City $city)
    {
        $rules = [
            'name' => 'required|string|unique:cities,name,' . $city->id,
            'province_id' => 'required|exists:provinces,id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $city->update([
                'province_id' => $request->input('province_id'),
                'name' => $request->input('name'),
            ]);

            return redirect(route('city.index'))->with('success', 'Kota/Kabupaten berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengubah data: ' . $e->getMessage());
        }
    }

    public function destroy(City $city)
    {
        if ($city->mosque()->exists()) {
            return redirect()->back()->with('error', 'Kota/Kabupaten sedang digunakan dalam data masjid dan tidak dapat dihapus');
        } else {
            $city->delete();
            return redirect()->back()->with('success', 'Kota/Kabupaten berhasil dihapus');
        }
    }
}
