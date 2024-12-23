<?php

namespace App\Http\Controllers\Admin;

use ZipArchive;
use App\Models\User;
use App\Models\CategoryArea;
use Illuminate\Http\Request;
use App\Models\CategoryMosque;
use App\Http\Controllers\Controller;

class ZipController extends Controller
{
    public function getPresentationFile(Request $request)
    {
        $categoryAreas = CategoryArea::all();
        $categoryMosques = CategoryMosque::all();
        $year = $request->input('tahun', date('Y'));

        $public_dir = public_path();
        $zipFileName = 'File-Presentasi-Lolos-Tahun-' . $year . '.zip';
        $zip = new ZipArchive;

        if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($categoryAreas as $categoryArea) {
                foreach ($categoryMosques as $categoryMosque) {
                    $users = User::with([
                        'mosque',
                        'mosque.presentationWithCustomYear' => fn($query) => $query->where('year', $year),
                        'mosque.presentationWithCustomYear.startAssessmentWithCustomYear' => fn($query) => $query->where('year', $year),
                    ])->whereHas('mosque', function ($q) use ($categoryArea, $categoryMosque) {
                        $q->where('category_area_id', $categoryArea->id)->where('category_mosque_id', $categoryMosque->id);
                    })->get();

                    $users = $users->map(function ($user) {
                        $totalValue = 0;

                        $weightPillarOne = 0.25;
                        $weightPillarTwo = 0.25;
                        $weightPillarThree = 0.20;
                        $weightPillarFour = 0.15;
                        $weightPillarFive = 0.15;

                        $presentation = $user->mosque->presentationWithCustomYear;

                        if ($presentation && $presentation->startAssessmentWithCustomYear->isNotEmpty()) {
                            $totalPillarOne = $presentation->startAssessmentWithCustomYear->sum('presentation_file_pillar_one');
                            $totalPillarTwo = $presentation->startAssessmentWithCustomYear->sum('presentation_file_pillar_two');
                            $totalPillarThree = $presentation->startAssessmentWithCustomYear->sum('presentation_file_pillar_three');
                            $totalPillarFour = $presentation->startAssessmentWithCustomYear->sum('presentation_file_pillar_four');
                            $totalPillarFive = $presentation->startAssessmentWithCustomYear->sum('presentation_file_pillar_five');

                            $totalValue += $totalPillarOne * $weightPillarOne;
                            $totalValue += $totalPillarTwo * $weightPillarTwo;
                            $totalValue += $totalPillarThree * $weightPillarThree;
                            $totalValue += $totalPillarFour * $weightPillarFour;
                            $totalValue += $totalPillarFive * $weightPillarFive;

                            $juryCount = $presentation->startAssessmentWithCustomYear->count();

                            if ($juryCount > 0) {
                                $totalValue = $totalValue / $juryCount;
                            }
                        }

                        $user->totalNilai = $totalValue;

                        return $user;
                    })->filter(function ($user) {
                        return $user->totalNilai > 0;
                    });

                    $getUsers = $users->sortByDesc('totalNilai')->take(3);

                    $folderName = "{$categoryArea->name} dan {$categoryMosque->name}/";

                    foreach ($getUsers as $user) {
                        if ($user->mosque->presentationWithCustomYear) {
                            $filePath = $user->mosque->presentationWithCustomYear->file;

                            if (file_exists($filePath)) {
                                $zip->addFile($filePath, $folderName . basename($filePath));
                            }
                        }
                    }
                }
            }

            $zip->close();
        }

        return response()->download($public_dir . '/' . $zipFileName)->deleteFileAfterSend(true);
    }
}
