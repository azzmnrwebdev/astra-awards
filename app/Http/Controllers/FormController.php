<?php

namespace App\Http\Controllers;

use App\Models\PillarOne;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function index()
    {
        return view('pages.form.index');
    }

    public function managementRelationship()
    {
        $mosqueId = Auth::user()->mosque->id;
        $pillarOne = PillarOne::where('mosque_id', $mosqueId)->first();

        return view('pages.form.management-relationship', compact('pillarOne'));
    }

    public function managementRelationshipAct(Request $request)
    {
        $rules = [
            'question_one' => 'required|string',
            'question_two' => 'required|string',
            'question_three' => 'required|string',
            'question_four' => 'required|string',
            'question_five' => 'required|string',
            'file_question_one' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_two_one' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_two_two' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_two_three' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_three' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_four' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_five' => 'file|mimes:pdf,jpg,jpeg,png',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mosqueId = Auth::user()->mosque->id;

        $pillarOne = PillarOne::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'mosque_id' => $mosqueId,
                'question_one' => $request->input('question_one'),
                'question_two' => $request->input('question_two'),
                'question_three' => $request->input('question_three'),
                'question_four' => $request->input('question_four'),
                'question_five' => $request->input('question_five'),
            ]
        );

        $pillarOne->file_question_one = $this->handleFileUpdate($request, 'file_question_one', $pillarOne->file_question_one, 'pillarOnes');
        $pillarOne->file_question_two_one = $this->handleFileUpdate($request, 'file_question_two_one', $pillarOne->file_question_two_one, 'pillarOnes');
        $pillarOne->file_question_two_two = $this->handleFileUpdate($request, 'file_question_two_two', $pillarOne->file_question_two_two, 'pillarOnes');
        $pillarOne->file_question_two_three = $this->handleFileUpdate($request, 'file_question_two_three', $pillarOne->file_question_two_three, 'pillarOnes');
        $pillarOne->file_question_three = $this->handleFileUpdate($request, 'file_question_three', $pillarOne->file_question_three, 'pillarOnes');
        $pillarOne->file_question_four = $this->handleFileUpdate($request, 'file_question_four', $pillarOne->file_question_four, 'pillarOnes');
        $pillarOne->file_question_five = $this->handleFileUpdate($request, 'file_question_five', $pillarOne->file_question_five, 'pillarOnes');

        $pillarOne->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function relationship()
    {
        return view('pages.form.relationship');
    }

    public function program()
    {
        return view('pages.form.program');
    }

    public function administration()
    {
        return view('pages.form.administration');
    }

    public function infrastructure()
    {
        return view('pages.form.infrastructure');
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
