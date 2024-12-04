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
        $year = date('Y');
        $userLogin = Auth::user();

        $mosque = $userLogin->mosque;
        $presentation = Presentation::where('mosque_id', $mosque->id)->where('year', $year)->first();

        return view('pages.presentation.index', compact('presentation'));
    }

    public function presentationAct(Request $request)
    {
        $rules = [
            'file' => 'required|file|mimes:pdf',
        ];

        $messages = [
            'file.required' => 'File presentasi wajib diupload.',
            'file.file' => 'File presentasi harus berbentuk file.',
            'file.mimes' => 'File presentasi yang diupload harus berformat PDF.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $year = date('Y');
        $mosque = Auth::user()->mosque;

        $pillarChecks = [
            'pillarOne',
            'pillarTwo',
            'pillarThree',
            'pillarFour',
            'pillarFive',
        ];

        $allPillarsComplete = true;

        foreach ($pillarChecks as $pillar) {
            if (!$mosque->$pillar()->where('year', $year)->exists()) {
                $allPillarsComplete = false;
                break;
            }
        }

        if ($allPillarsComplete) {
            DB::beginTransaction();

            try {
                $presentation = Presentation::where('mosque_id', $mosque->id)->where('year', $year)->first();
                $filePath = $this->handleFileUpdate($request, $mosque->name, 'file', $presentation->file ?? null, 'presentations');

                if ($filePath) {
                    $presentation = Presentation::updateOrCreate(
                        ['id' => $request->input('id')],
                        [
                            'mosque_id' => $mosque->id,
                            'file' => $filePath,
                            'year' => $year,
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

    private function handleFileUpdate(Request $request, $mosqueName, $inputName, $currentFilePath, $path)
    {
        if ($request->hasFile($inputName)) {
            if ($currentFilePath && Storage::disk('public')->exists(Str::after($currentFilePath, 'storage/'))) {
                Storage::disk('public')->delete(Str::after($currentFilePath, 'storage/'));
            }

            return $this->handleUploadFile($mosqueName, $request->file($inputName), $path);
        }

        return $currentFilePath;
    }

    private function handleUploadFile($mosqueName, $file, $path)
    {
        $mosque = strtolower(preg_replace('/\s+/', '_', preg_replace('/\W+/', '', $mosqueName)));
        $fileName = 'file_presentasi_' . $mosque . '_' . sha1(mt_rand(1, 999999) . microtime()) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs($path, $fileName, 'public');

        return 'storage/' . $filePath;
    }
}
