<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Models\CategoryMosque;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryMosqueController extends Controller
{
    public function index(Request $request)
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama'],
            ['class' => 'text-start py-3', 'label' => 'Deskripsi'],
            ['class' => 'text-center py-3', 'label' => 'Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $query = CategoryMosque::query();
        $search = $request->input('search');

        if (!empty($search)) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        $categories = $query->orderByDesc('updated_at')->latest('created_at')->paginate(10);

        return view('admin.pages.category_mosque.index', compact('theadName', 'search', 'categories'));
    }

    public function create()
    {
        return view('admin.pages.category_mosque.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|unique:category_mosques,name',
            'description' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            CategoryMosque::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);

            return redirect(route('categoryMosque.index'))->with('success', 'Kategori Masjid berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit(CategoryMosque $categoryMosque)
    {
        return view('admin.pages.category_mosque.edit', compact('categoryMosque'));
    }

    public function update(Request $request, CategoryMosque $categoryMosque)
    {
        $rules = [
            'name' => 'required|string|unique:category_mosques,name,' . $categoryMosque->id,
            'description' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $categoryMosque->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);

            return redirect(route('categoryMosque.index'))->with('success', 'Kategori Masjid berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengubah data: ' . $e->getMessage());
        }
    }

    public function destroy(CategoryMosque $categoryMosque)
    {
        if ($categoryMosque->mosque()->exists()) {
            return redirect()->back()->with('error', 'Kategori Masjid sedang digunakan dalam data masjid dan tidak dapat dihapus');
        } else {
            $categoryMosque->delete();
            return redirect()->back()->with('success', 'Kategori Masjid berhasil dihapus');
        }
    }
}
