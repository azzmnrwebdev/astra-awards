<?php

namespace App\Http\Controllers;

use App\Models\CategoryArea;
use App\Models\CategoryMosque;
use App\Models\Presentation;
use App\Models\StartAssessment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PresentationController extends Controller
{
    public function presentation(Request $request)
    {
        $userLogin = Auth::user();

        if ($userLogin->role === "jury") {
            $categoryAreas = CategoryArea::all();
            $categoryMosques = CategoryMosque::all();

            $allUsers = collect();
            $search = $request->input('pencarian');

            foreach ($categoryAreas as $area) {
                foreach ($categoryMosques as $mosque) {
                    $users = User::with([
                        'mosque',
                        'mosque.company',
                        'mosque.presentation',
                        'mosque.pillarOne.committeeAssessmnet',
                        'mosque.pillarTwo.committeeAssessmnet',
                        'mosque.pillarThree.committeeAssessmnet',
                        'mosque.pillarFour.committeeAssessmnet',
                        'mosque.pillarFive.committeeAssessmnet'
                    ])->whereHas('mosque', function ($q) use ($area, $mosque) {
                        $q->where('category_area_id', $area->id)
                            ->where('category_mosque_id', $mosque->id);
                    })->where(function ($q) {
                        $q->whereHas('mosque.presentation');
                    })->when($search, function ($query) use ($search) {
                        $query->where(function ($q) use ($search) {
                            $q->whereHas('mosque', function ($q2) use ($search) {
                                $q2->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
                            })->orWhereHas('mosque.company', function ($q2) use ($search) {
                                $q2->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
                            });
                        });
                    })->get();

                    $users = $users->map(function ($user) {
                        $totalValue = 0;

                        $weightPillarOne = 0.25;
                        $weightPillarTwo = 0.25;
                        $weightPillarThree = 0.20;
                        $weightPillarFour = 0.15;
                        $weightPillarFive = 0.15;

                        if ($user->mosque->pillarOne && $user->mosque->pillarOne->committeeAssessmnet) {
                            $pillarOneTotal = 0;
                            $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_one;
                            $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_two;
                            $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_three;
                            $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_four;
                            $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_five;
                            $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_six;
                            $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_seven;

                            $totalValue += $pillarOneTotal * $weightPillarOne;
                        }

                        if ($user->mosque->pillarTwo && $user->mosque->pillarTwo->committeeAssessmnet) {
                            $pillarTwoTotal = 0;
                            $pillarTwoTotal += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_two;
                            $pillarTwoTotal += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_three;
                            $pillarTwoTotal += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_four;
                            $pillarTwoTotal += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_five;

                            $totalValue += $pillarTwoTotal * $weightPillarTwo;
                        }

                        if ($user->mosque->pillarThree && $user->mosque->pillarThree->committeeAssessmnet) {
                            $pillarThreeTotal = 0;
                            $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_one;
                            $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_two;
                            $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_three;
                            $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_four;
                            $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_five;
                            $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_six;

                            $totalValue += $pillarThreeTotal * $weightPillarThree;
                        }

                        if ($user->mosque->pillarFour && $user->mosque->pillarFour->committeeAssessmnet) {
                            $pillarFourTotal = 0;
                            $pillarFourTotal += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_one;
                            $pillarFourTotal += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_two;
                            $pillarFourTotal += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_three;
                            $pillarFourTotal += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_four;
                            $pillarFourTotal += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_five;

                            $totalValue += $pillarFourTotal * $weightPillarFour;
                        }

                        if ($user->mosque->pillarFive && $user->mosque->pillarFive->committeeAssessmnet) {
                            $pillarFiveTotal = 0;
                            $pillarFiveTotal += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_one;
                            $pillarFiveTotal += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_two;
                            $pillarFiveTotal += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_three;
                            $pillarFiveTotal += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_four;
                            $pillarFiveTotal += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_five;

                            $totalValue += $pillarFiveTotal * $weightPillarFive;
                        }

                        $user->totalNilai = $totalValue;

                        return $user;
                    })->filter(function ($user) {
                        return $user->totalNilai > 0;
                    });

                    $topUsers = $users->sortByDesc('totalNilai')->take(5);
                    $allUsers = $allUsers->merge($topUsers);
                }
            }

            return view('pages.presentation.index', compact('search', 'allUsers'));
        }

        $mosque = $userLogin->mosque;
        $presentation = Presentation::where('mosque_id', $mosque->id)->first();

        return view('pages.presentation.index', compact('presentation'));
    }

    public function presentationAssessment(User $user)
    {
        $presentationId = $user->mosque->presentation->id ?? '';
        $startAssessment = StartAssessment::where('presentation_id', $presentationId)->first();

        return view('pages.presentation.assessment', compact('user', 'presentationId', 'startAssessment'));
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
