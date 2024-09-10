<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BusinessLine;
use Exception;
use Illuminate\Support\Facades\Validator;

class BusinessLineController extends Controller
{
    public function index()
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $businessLines = BusinessLine::orderByDesc('updated_at')->latest('created_at')->paginate(10);

        return view('admin.pages.business_line.index', compact('theadName', 'businessLines'));
    }

    public function create()
    {
        return view('admin.pages.business_line.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|unique:business_lines,name',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            BusinessLine::create([
                'name' => $request->input('name'),
            ]);

            return redirect(route('business_line.index'))->with('success', 'Lini bisnis baru berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit(BusinessLine $businessLine)
    {
        return view('admin.pages.business_line.edit', compact('businessLine'));
    }

    public function update(Request $request, BusinessLine $businessLine)
    {
        $rules = [
            'name' => 'required|string|unique:business_lines,name,' . $businessLine->id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $businessLine->update([
                'name' => $request->input('name'),
            ]);

            return redirect(route('business_line.index'))->with('success', 'Lini bisnis lama berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function destroy(BusinessLine $businessLine)
    {
        if ($businessLine->company()->exists()) {
            return redirect()->back()->with('error', 'Lini bisnis sedang digunakan dalam data perusahaan dan tidak dapat dihapus');
        } else {
            $businessLine->delete();
            return redirect()->back()->with('success', 'Lini bisnis berhasil dihapus');
        }
    }
}
