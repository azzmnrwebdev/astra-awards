<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryArea;
use Exception;
use Illuminate\Support\Facades\Validator;

class CategoryAreaController extends Controller
{
    public function index()
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $categories = CategoryArea::orderByDesc('updated_at')->latest('created_at')->paginate(10);

        return view('admin.pages.category.index', compact('theadName', 'categories'));
    }

    public function create()
    {
        return view('admin.pages.category.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string||unique:category_areas,name',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            CategoryArea::create([
                'name' => $request->input('name'),
            ]);

            return redirect(route('category.index'))->with('success', 'Kategori area baru berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit(CategoryArea $category)
    {
        return view('admin.pages.category.edit', compact('category'));
    }

    public function update(Request $request, CategoryArea $category)
    {
        $rules = [
            'name' => 'required|string||unique:category_areas,name,' . $category->id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $category->update([
                'name' => $request->input('name'),
            ]);

            return redirect(route('category.index'))->with('success', 'Kategori area lama berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function destroy(CategoryArea $category)
    {
        if ($category->mosque()->exists()) {
            return redirect()->back()->with('error', 'Kategori sedang digunakan dalam data masjid dan tidak dapat dihapus');
        } else {
            $category->delete();
            return redirect()->back()->with('success', 'Kategori berhasil dihapus');
        }
    }
}
