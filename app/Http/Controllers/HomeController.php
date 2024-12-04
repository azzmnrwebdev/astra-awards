<?php

namespace App\Http\Controllers;

use App\Models\Mosque;
use App\Models\PillarOne;
use App\Models\PillarTwo;
use App\Models\PillarThree;
use App\Models\PillarFour;
use App\Models\PillarFive;
use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function information()
    {
        $year = date('Y');
        $mosque = Auth::user()->mosque;

        if (!$mosque) {
            return view('pages.information');
        }

        // Pillar One
        $pillarOne = PillarOne::where('mosque_id', $mosque->id)->where('year', $year)->first();
        $pillarOneFields = ['question_one', 'question_two', 'file_question_two_one', 'file_question_two_two', 'question_three', 'question_four', 'question_five'];

        $pillarOneCompleted = 0;
        $totalFields = count($pillarOneFields);

        if ($pillarOne) {
            foreach ($pillarOneFields as $field) {
                if (!empty($pillarOne->$field)) {
                    $pillarOneCompleted++;
                }
            }
        }

        $pillarOneCompletion = ($pillarOneCompleted / $totalFields) * 100;
        $pillarOneCompletion = round($pillarOneCompletion);

        // Pillar Two
        $pillarTwo = PillarTwo::where('mosque_id', $mosque->id)->where('year', $year)->first();
        $pillarTwoFields = ['question_two', 'question_three', 'question_four', 'question_five'];

        $pillarTwoCompleted = 0;
        $totalFields = count($pillarTwoFields);

        if ($pillarTwo) {
            foreach ($pillarTwoFields as $field) {
                if (!empty($pillarTwo->$field)) {
                    $pillarTwoCompleted++;
                }
            }
        }

        $pillarTwoCompletion = ($pillarTwoCompleted / $totalFields) * 100;
        $pillarTwoCompletion = round($pillarTwoCompletion);

        // Pillar Three
        $pillarThree = PillarThree::where('mosque_id', $mosque->id)->where('year', $year)->first();
        $pillarThreeFields = ['question_one', 'question_two', 'question_three', 'question_four', 'question_five', 'question_six'];

        $pillarThreeCompleted = 0;
        $totalFields = count($pillarThreeFields);

        if ($pillarThree) {
            foreach ($pillarThreeFields as $field) {
                if (!empty($pillarThree->$field)) {
                    $pillarThreeCompleted++;
                }
            }
        }

        $pillarThreeCompletion = ($pillarThreeCompleted / $totalFields) * 100;
        $pillarThreeCompletion = round($pillarThreeCompletion);

        // Pillar Four
        $pillarFour = PillarFour::where('mosque_id', $mosque->id)->where('year', $year)->first();
        $pillarFourFields = ['question_one', 'question_two', 'question_three', 'question_four', 'question_five'];

        $pillarFourCompleted = 0;
        $totalFields = count($pillarFourFields);

        if ($pillarFour) {
            foreach ($pillarFourFields as $field) {
                if (!empty($pillarFour->$field)) {
                    $pillarFourCompleted++;
                }
            }
        }

        $pillarFourCompletion = ($pillarFourCompleted / $totalFields) * 100;
        $pillarFourCompletion = round($pillarFourCompletion);

        // Pillar Five
        $pillarFive = PillarFive::where('mosque_id', $mosque->id)->where('year', $year)->first();
        $pillarFiveFields = ['question_one', 'question_two', 'question_three', 'question_four', 'question_five'];

        $pillarFiveCompleted = 0;
        $totalFields = count($pillarFiveFields);

        if ($pillarFive) {
            foreach ($pillarFiveFields as $field) {
                if (!empty($pillarFive->$field)) {
                    $pillarFiveCompleted++;
                }
            }
        }

        $pillarFiveCompletion = ($pillarFiveCompleted / $totalFields) * 100;
        $pillarFiveCompletion = round($pillarFiveCompletion);

        // Presentation
        $presentation = Presentation::where('mosque_id', $mosque->id)->where('year', $year)->first();
        $presentationFields = ['file'];

        $presentationCompleted = 0;
        $totalFields = count($presentationFields);

        if ($presentation) {
            foreach ($presentationFields as $field) {
                if (!empty($presentation->$field)) {
                    $presentationCompleted++;
                }
            }
        }

        $presentationCompletion = ($presentationCompleted / $totalFields) * 100;
        $presentationCompletion = round($presentationCompletion);

        // Kirim data ke view
        return view('pages.information', compact(
            'mosque',
            'pillarOneCompletion',
            'pillarTwoCompletion',
            'pillarThreeCompletion',
            'pillarFourCompletion',
            'pillarFiveCompletion',
            'presentationCompletion'
        ));
    }
}
