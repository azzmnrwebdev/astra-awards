<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryArea;
use Exception;
use Illuminate\Support\Facades\Validator;

class CategoryAreaController extends Controller
{
    public function index(Request $request)
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama'],
            ['class' => 'text-center py-3', 'label' => 'Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $query = CategoryArea::query();
        $search = $request->input('pencarian');

        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        $categories = $query->orderByDesc('updated_at')->latest('created_at')->paginate(10);

        return view('admin.pages.category_area.index', compact('theadName', 'search', 'categories'));
    }

    public function create()
    {
        return view('admin.pages.category_area.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|unique:category_areas,name',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            CategoryArea::create([
                'name' => $request->input('name'),
            ]);

            return redirect(route('categoryArea.index'))->with('success', 'Kategori Area berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit(CategoryArea $categoryArea)
    {
        return view('admin.pages.category_area.edit', compact('categoryArea'));
    }

    public function update(Request $request, CategoryArea $categoryArea)
    {
        $rules = [
            'name' => 'required|string|unique:category_areas,name,' . $categoryArea->id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $categoryArea->update([
                'name' => $request->input('name'),
            ]);

            return redirect(route('categoryArea.index'))->with('success', 'Kategori Area berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengubah data: ' . $e->getMessage());
        }
    }

    public function destroy(CategoryArea $categoryArea)
    {
        if ($categoryArea->mosque()->exists()) {
            return redirect()->back()->with('error', 'Kategori Area sedang digunakan dalam data masjid dan tidak dapat dihapus');
        } else {
            $categoryArea->delete();
            return redirect()->back()->with('success', 'Kategori Area berhasil dihapus');
        }
    }
}
