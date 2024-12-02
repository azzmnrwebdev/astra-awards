<?php

namespace App\Http\Controllers\Admin;

use ZipArchive;
use App\Models\User;
use App\Models\CategoryArea;
use App\Models\CategoryMosque;
use App\Http\Controllers\Controller;

class ZipController extends Controller
{
    public function getPresentationFile()
    {
        $categoryAreas = CategoryArea::all();
        $categoryMosques = CategoryMosque::all();

        $public_dir = public_path();
        $zipFileName = 'presentations.zip';
        $zip = new ZipArchive;

        if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($categoryAreas as $categoryArea) {
                foreach ($categoryMosques as $categoryMosque) {
                    $users = User::with([
                        'mosque',
                        'mosque.presentation',
                        'mosque.presentation.startAssessment'
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

                        if ($user->mosque->presentation && $user->mosque->presentation->startAssessment->isNotEmpty()) {
                            $totalPillarOne = $user->mosque->presentation->startAssessment->sum('presentation_file_pillar_one');
                            $totalPillarTwo = $user->mosque->presentation->startAssessment->sum('presentation_file_pillar_two');
                            $totalPillarThree = $user->mosque->presentation->startAssessment->sum('presentation_file_pillar_three');
                            $totalPillarFour = $user->mosque->presentation->startAssessment->sum('presentation_file_pillar_four');
                            $totalPillarFive = $user->mosque->presentation->startAssessment->sum('presentation_file_pillar_five');

                            $totalValue += $totalPillarOne * $weightPillarOne;
                            $totalValue += $totalPillarTwo * $weightPillarTwo;
                            $totalValue += $totalPillarThree * $weightPillarThree;
                            $totalValue += $totalPillarFour * $weightPillarFour;
                            $totalValue += $totalPillarFive * $weightPillarFive;

                            $juryCount = $user->mosque->presentation->startAssessment->count();

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
                        if ($user->mosque->presentation) {
                            $filePath = $user->mosque->presentation->file;

                            if (file_exists($filePath)) {
                                // dd('bisa');
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
