<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PresentationController extends Controller
{
    public function presentation()
    {
        $mosqueId = Auth::user()->mosque->id;
        $presentation = Presentation::where('mosque_id', $mosqueId)->first();

        return view('pages.presentation.index', compact('presentation'));
    }

    public function presentationAct(Request $request)
    {
        $rules = [
            'file' => 'required|file|mimes:pptx',
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
            $presentation = Presentation::where('mosque_id', $mosque->id)->first();

            $presentation = Presentation::updateOrCreate(
                ['id' => $request->input('id')],
                [
                    'mosque_id' => $mosque->id,
                    'file' => $this->handleFileUpdate($request, 'file', $presentation->file ?? null, 'presentations'),
                ]
            );

            return redirect()->back()->with('success', 'File presentasi berhasil disimpan.');
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
