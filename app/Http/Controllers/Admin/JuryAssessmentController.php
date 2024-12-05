<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\CategoryArea;
use Illuminate\Http\Request;
use App\Models\CategoryMosque;
use App\Models\StartAssessment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JuryAssessmentController extends Controller
{
    public function index()
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'Peringkat'],
            ['class' => 'text-center py-3', 'label' => 'Nama Masjid/Musala'],
            ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
            ['class' => 'text-center py-3', 'label' => 'Provinsi'],
            ['class' => 'text-center py-3', 'label' => 'Status'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $categories = [];
        $categoryAreas = CategoryArea::all();
        $categoryMosques = CategoryMosque::all();

        foreach ($categoryAreas as $area) {
            foreach ($categoryMosques as $mosque) {
                $topUsers = User::with([
                    'mosque',
                    'mosque.pillarOne',
                    'mosque.pillarTwo',
                    'mosque.pillarThree',
                    'mosque.pillarFour',
                    'mosque.pillarFive',
                    'mosque.pillarOne.committeeAssessmnet',
                    'mosque.pillarTwo.committeeAssessmnet',
                    'mosque.pillarThree.committeeAssessmnet',
                    'mosque.pillarFour.committeeAssessmnet',
                    'mosque.pillarFive.committeeAssessmnet'
                ])->whereHas('mosque', function ($q) use ($area, $mosque) {
                    $q->where('category_area_id', $area->id)->where('category_mosque_id', $mosque->id);
                })->where(function ($q) {
                    $q->whereHas('mosque.presentation');
                })->get();

                $topUsers = $topUsers->map(function ($user) {
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

                $categories[] = [
                    'title' => $area->name . ' dan ' . $mosque->name,
                    'datas' => $topUsers->sortByDesc('totalNilai')->take(5),
                ];
            }
        }

        return view('admin.pages.assessment.jury-assessment', compact('theadName', 'categories'));
    }

    public function assessment(User $user)
    {
        $year = date('Y');
        $juryId = Auth::user()->id;
        $presentationId = $user->mosque->presentation->id ?? '';
        $startAssessment = StartAssessment::where('presentation_id', $presentationId)->where('jury_id', $juryId)->where('year', $year)->first();

        return view('admin.pages.assessment.jury-assessment-edit', compact('user', 'presentationId', 'startAssessment'));
    }

    public function assessmentAct(Request $request, User $user)
    {
        $rules = [
            'presentation_file_pillar_two' => 'required',
            'presentation_file_pillar_one' => 'required',
            'presentation_file_pillar_three' => 'required',
            'presentation_file_pillar_four' => 'required',
            'presentation_file_pillar_five' => 'required',
        ];

        $messages = [
            'presentation_file_pillar_two.required' => 'Nilai untuk pilar 1 tidak boleh kosong.',
            'presentation_file_pillar_one.required' => 'Nilai untuk pilar 2 tidak boleh kosong.',
            'presentation_file_pillar_three.required' => 'Nilai untuk pilar 3 tidak boleh kosong.',
            'presentation_file_pillar_four.required' => 'Nilai untuk pilar 4 tidak boleh kosong.',
            'presentation_file_pillar_five.required' => 'Nilai untuk pilar 5 tidak boleh kosong.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $year = date('Y');
            $id = $request->input('id');

            StartAssessment::updateOrCreate(
                ['id' => $id],
                [
                    'presentation_id' => $request->input('presentation_id'),
                    'jury_id' => Auth::id(),
                    'presentation_file_pillar_two' => $request->input('presentation_file_pillar_two'),
                    'presentation_file_pillar_one' => $request->input('presentation_file_pillar_one'),
                    'presentation_file_pillar_three' => $request->input('presentation_file_pillar_three'),
                    'presentation_file_pillar_four' => $request->input('presentation_file_pillar_four'),
                    'presentation_file_pillar_five' => $request->input('presentation_file_pillar_five'),
                    'year' => $year
                ]
            );

            $message = $id ? 'Penilaian Awal berhasil diperbarui.' : 'Penilaian Awal berhasil disimpan.';

            return redirect()->back()->with('success', $message);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan pada server.');
        }
    }
}
