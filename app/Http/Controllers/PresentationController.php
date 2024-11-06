<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Presentation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PresentationController extends Controller
{
    public function presentation(Request $request)
    {
        $userLogin = Auth::user();

        $mosque = $userLogin->mosque;
        $presentation = Presentation::where('mosque_id', $mosque->id)->first();

        return view('pages.presentation.index', compact('presentation'));
    }

    public function presentationAct(Request $request)
    {
        $rules = [
            'file' => 'required|file|mimes:pdf',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mosque = Auth::user()->mosque;

        $checkPillarOne = $mosque->pillarOne ? true : false;
        $checkPillarTwo = $mosque->pillarTwo ? true : false;
        $checkPillarThree = $mosque->pillarThree ? true : false;
        $checkPillarFour = $mosque->pillarFour ? true : false;
        $checkPillarFive = $mosque->pillarFive ? true : false;

        if ($checkPillarOne && $checkPillarTwo && $checkPillarThree && $checkPillarFour && $checkPillarFive) {
            DB::beginTransaction();

            try {
                $presentation = Presentation::where('mosque_id', $mosque->id)->first();
                $filePath = $this->handleFileUpdate($request, 'file', $presentation->file ?? null, 'presentations');

                if ($filePath) {
                    $presentation = Presentation::updateOrCreate(
                        ['id' => $request->input('id')],
                        [
                            'mosque_id' => $mosque->id,
                            'file' => $filePath,
                        ]
                    );

                    DB::commit();

                    return redirect()->back()->with('success', 'File presentasi berhasil disimpan.');
                } else {
                    throw new \Exception("Gagal menyimpan file ke storage");
                }
            } catch (\Exception $e) {
                DB::rollBack();

                return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan file. Silakan coba lagi.');
            }
        } else {
            return redirect()->back()->with('error', 'Semua pilar harus lengkap sebelum mengunggah file presentasi.');
        }
    }

    private function handleFileUpdate(Request $request, $inputName, $currentFilePath, $path)
    {
        if ($request->hasFile($inputName)) {
            if ($currentFilePath && Storage::disk('public')->exists(Str::after($currentFilePath, 'storage/'))) {
                Storage::disk('public')->delete(Str::after($currentFilePath, 'storage/'));
            }

            return $this->handleUploadFile($inputName, $request->file($inputName), $path);
        }

        return $currentFilePath;
    }

    private function handleUploadFile($name, $file, $path)
    {
        $fileName = $name . '-' . sha1(mt_rand(1, 999999) . microtime()) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs($path, $fileName, 'public');

        return 'storage/' . $filePath;
    }
}
