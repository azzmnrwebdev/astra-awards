<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Carbon\Carbon;
use App\Models\Mosque;
use App\Models\Province;
use iio\libmergepdf\Merger;
use App\Models\CategoryArea;
use App\Models\BusinessLine;
use App\Models\CategoryMosque;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function getUsersByCategory($categoryAreaId, $categoryMosqueId, Request $request)
    {
        $categoryArea = CategoryArea::find($categoryAreaId);
        $categoryMosque = CategoryMosque::find($categoryMosqueId);

        $search = $request->query('search');

        $mosques = Mosque::with(['user', 'company', 'categoryArea', 'categoryMosque'])
            ->where('category_area_id', $categoryAreaId)
            ->where('category_mosque_id', $categoryMosqueId);

        if (!empty($search)) {
            $mosques->where(function ($query) use ($search) {
                $loweredSearch = strtolower($search);

                $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%'])
                    ->orWhereHas('user', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('company', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('categoryArea', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('categoryMosque', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    });
            });
        }

        $mosques = $mosques->get();

        $data = [
            'mosques' => $mosques,
            'categoryArea' => $categoryArea,
            'categoryMosque' => $categoryMosque,
            'date' => Carbon::now()->toDateString(),
        ];

        $categoryAreaName = str_replace([' ', ','], ['-', ''], $categoryArea->name);
        $categoryMosqueName = str_replace([' ', ','], ['-', ''], $categoryMosque->name);

        $pdfPortrait = PDF::loadView('admin.pdf.users-by-category-cover', ['categoryArea' => $categoryArea, 'categoryMosque' => $categoryMosque])
            ->setPaper('a4', 'portrait')
            ->setOption([
                'fontDir' => public_path('/fonts'),
                'fontCache' => public_path('/fonts'),
                'defaultFont' => 'Inter'
            ]);

        $pdfLandscape = PDF::loadView('admin.pdf.users-by-category-page', $data)
            ->setPaper('a4', 'landscape')
            ->setOption([
                'fontDir' => public_path('/fonts'),
                'fontCache' => public_path('/fonts'),
                'defaultFont' => 'Inter'
            ]);

        $pdfPortraitPath = storage_path('app/temp_portrait.pdf');
        $pdfLandscapePath = storage_path('app/temp_landscape.pdf');
        $pdfPortrait->save($pdfPortraitPath);
        $pdfLandscape->save($pdfLandscapePath);

        $merger = new Merger;
        $merger->addFile($pdfPortraitPath);
        $merger->addFile($pdfLandscapePath);

        $mergedPdf = $merger->merge();

        unlink($pdfPortraitPath);
        unlink($pdfLandscapePath);

        return response($mergedPdf, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Daftar-Peserta-Kategori-' . $categoryAreaName . '-dan-' . $categoryMosqueName . '.pdf"');
    }

    public function getUsersByProvince($provinceId, Request $request)
    {
        $province = Province::with(['city'])->find($provinceId);

        $search = $request->query('search');

        $mosques = Mosque::with(['user', 'company', 'city'])->whereHas('city', function ($query) use ($provinceId) {
            $query->where('province_id', $provinceId);
        });

        if (!empty($search)) {
            $mosques->where(function ($query) use ($search) {
                $loweredSearch = strtolower($search);

                $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%'])
                    ->orWhereHas('user', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('company', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('city', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    });
            });
        }

        $mosques = $mosques->get();

        $data = [
            'mosques' => $mosques,
            'province' => $province,
            'date' => Carbon::now()->toDateString(),
        ];

        $provinceName = str_replace([' ', ','], ['-', ''], $province->name);

        $pdfPortrait = PDF::loadView('admin.pdf.users-by-province-cover', ['province' => $province])
            ->setPaper('a4', 'portrait')
            ->setOption([
                'fontDir' => public_path('/fonts'),
                'fontCache' => public_path('/fonts'),
                'defaultFont' => 'Inter'
            ]);

        $pdfLandscape = PDF::loadView('admin.pdf.users-by-province-page', $data)
            ->setPaper('a4', 'landscape')
            ->setOption([
                'fontDir' => public_path('/fonts'),
                'fontCache' => public_path('/fonts'),
                'defaultFont' => 'Inter'
            ]);

        $pdfPortraitPath = storage_path('app/temp_portrait.pdf');
        $pdfLandscapePath = storage_path('app/temp_landscape.pdf');
        $pdfPortrait->save($pdfPortraitPath);
        $pdfLandscape->save($pdfLandscapePath);

        $merger = new Merger;
        $merger->addFile($pdfPortraitPath);
        $merger->addFile($pdfLandscapePath);

        $mergedPdf = $merger->merge();

        unlink($pdfPortraitPath);
        unlink($pdfLandscapePath);

        return response($mergedPdf, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Daftar-Peserta-Provinsi-' . $provinceName . '.pdf"');
    }

    public function getUsersByBusinessLine($businessLineId, Request $request)
    {
        $businessLine = BusinessLine::with(['company'])->find($businessLineId);

        $search = $request->query('search');

        $mosques = Mosque::with(['user', 'company', 'company.businessLine', 'company.parentCompany'])->whereHas('company', function ($query) use ($businessLineId) {
            $query->where('business_line_id', $businessLineId);
        });

        if (!empty($search)) {
            $mosques->where(function ($query) use ($search) {
                $loweredSearch = strtolower($search);

                $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%'])
                    ->orWhereHas('user', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('company', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('company.businessLine', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    });
            });
        }

        $mosques = $mosques->get();

        $data = [
            'mosques' => $mosques,
            'businessLine' => $businessLine,
            'date' => Carbon::now()->toDateString(),
        ];

        $businessLineName = str_replace([' ', ','], ['-', ''], $businessLine->name);

        $pdfPortrait = PDF::loadView('admin.pdf.users-by-business-line-cover', ['businessLine' => $businessLine])
            ->setPaper('a4', 'portrait')
            ->setOption([
                'fontDir' => public_path('/fonts'),
                'fontCache' => public_path('/fonts'),
                'defaultFont' => 'Inter'
            ]);

        $pdfLandscape = PDF::loadView('admin.pdf.users-by-business-line-page', $data)
            ->setPaper('a4', 'landscape')
            ->setOption([
                'fontDir' => public_path('/fonts'),
                'fontCache' => public_path('/fonts'),
                'defaultFont' => 'Inter'
            ]);

        $pdfPortraitPath = storage_path('app/temp_portrait.pdf');
        $pdfLandscapePath = storage_path('app/temp_landscape.pdf');
        $pdfPortrait->save($pdfPortraitPath);
        $pdfLandscape->save($pdfLandscapePath);

        $merger = new Merger;
        $merger->addFile($pdfPortraitPath);
        $merger->addFile($pdfLandscapePath);

        $mergedPdf = $merger->merge();

        unlink($pdfPortraitPath);
        unlink($pdfLandscapePath);

        return response($mergedPdf, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Daftar-Peserta-Lini-Bisnis-' . $businessLineName . '.pdf"');
    }

    public function getFormAssessment(User $user)
    {
        $weightPillarOne = 0.25;
        $weightPillarTwo = 0.25;
        $weightPillarThree = 0.20;
        $weightPillarFour = 0.15;
        $weightPillarFive = 0.15;

        $pillarOne = $user->mosque->pillarOne;
        $pillarTwo = $user->mosque->pillarTwo;
        $pillarThree = $user->mosque->pillarThree;
        $pillarFour = $user->mosque->pillarFour;
        $pillarFive = $user->mosque->pillarFive;

        $pillarOneTotalValue = $pillarTwoTotalValue = $pillarThreeTotalValue = $pillarFourTotalValue = $pillarFiveTotalValue = 0;

        if ($pillarOne && $pillarOne->committeeAssessmnet?->pillar_one_id) {
            $pillarOneAssessment = $pillarOne->committeeAssessmnet;

            $pillarOneTotalValue =
                $pillarOneAssessment->pillar_one_question_one +
                $pillarOneAssessment->pillar_one_question_two +
                $pillarOneAssessment->pillar_one_question_three +
                $pillarOneAssessment->pillar_one_question_four +
                $pillarOneAssessment->pillar_one_question_five +
                $pillarOneAssessment->pillar_one_question_six +
                $pillarOneAssessment->pillar_one_question_seven;
        }

        if ($pillarTwo && $pillarTwo->committeeAssessmnet?->pillar_two_id) {
            $pillarTwoAssessment = $pillarTwo->committeeAssessmnet;

            $pillarTwoTotalValue =
                $pillarTwoAssessment->pillar_two_question_two +
                $pillarTwoAssessment->pillar_two_question_three +
                $pillarTwoAssessment->pillar_two_question_four +
                $pillarTwoAssessment->pillar_two_question_five;
        }

        if ($pillarThree && $pillarThree->committeeAssessmnet?->pillar_three_id) {
            $pillarThreeAssessment = $pillarThree->committeeAssessmnet;

            $pillarThreeTotalValue =
                $pillarThreeAssessment->pillar_three_question_one +
                $pillarThreeAssessment->pillar_three_question_two +
                $pillarThreeAssessment->pillar_three_question_three +
                $pillarThreeAssessment->pillar_three_question_four +
                $pillarThreeAssessment->pillar_three_question_five +
                $pillarThreeAssessment->pillar_three_question_six;
        }

        if ($pillarFour && $pillarFour->committeeAssessmnet?->pillar_four_id) {
            $pillarFourAssessment = $pillarFour->committeeAssessmnet;

            $pillarFourTotalValue =
                $pillarFourAssessment->pillar_four_question_one +
                $pillarFourAssessment->pillar_four_question_two +
                $pillarFourAssessment->pillar_four_question_three +
                $pillarFourAssessment->pillar_four_question_four +
                $pillarFourAssessment->pillar_four_question_five;
        }

        if ($pillarFive && $pillarFive->committeeAssessmnet?->pillar_five_id) {
            $pillarFiveAssessment = $pillarFive->committeeAssessmnet;

            $pillarFiveTotalValue =
                $pillarFiveAssessment->pillar_five_question_one +
                $pillarFiveAssessment->pillar_five_question_two +
                $pillarFiveAssessment->pillar_five_question_three +
                $pillarFiveAssessment->pillar_five_question_four +
                $pillarFiveAssessment->pillar_five_question_five;
        }

        $valueSummary = (
            ($pillarOneTotalValue * $weightPillarOne) +
            ($pillarTwoTotalValue * $weightPillarTwo) +
            ($pillarThreeTotalValue * $weightPillarThree) +
            ($pillarFourTotalValue * $weightPillarFour) +
            ($pillarFiveTotalValue * $weightPillarFive)
        );

        $data = [
            'user' => $user,
            'pillarTwoValue' => $pillarTwoTotalValue,
            'pillarOneValue' => $pillarOneTotalValue,
            'pillarThreeValue' => $pillarThreeTotalValue,
            'pillarFourValue' => $pillarFourTotalValue,
            'pillarFiveValue' => $pillarFiveTotalValue,
            'totalValue' => $pillarTwoTotalValue + $pillarOneTotalValue + $pillarThreeTotalValue + $pillarFourTotalValue + $pillarFiveTotalValue,
            'valueSummary' => str_replace('.', ',', $valueSummary),
            'date' => Carbon::now()->toDateString(),
        ];

        $pdfPortrait = PDF::loadView('pdf.form-assessment-cover')
            ->setPaper('a4', 'portrait')
            ->setOption([
                'fontDir' => public_path('/fonts'),
                'fontCache' => public_path('/fonts'),
                'defaultFont' => 'Inter'
            ]);

        $pdfLandscape = PDF::loadView('pdf.form-assessment-page', $data)
            ->setPaper('a4', 'landscape')
            ->setOption([
                'fontDir' => public_path('/fonts'),
                'fontCache' => public_path('/fonts'),
                'defaultFont' => 'Inter'
            ]);

        $pdfPortraitPath = storage_path('app/temp_portrait.pdf');
        $pdfLandscapePath = storage_path('app/temp_landscape.pdf');
        $pdfPortrait->save($pdfPortraitPath);
        $pdfLandscape->save($pdfLandscapePath);

        $merger = new Merger;
        $merger->addFile($pdfPortraitPath);
        $merger->addFile($pdfLandscapePath);

        $mergedPdf = $merger->merge();

        unlink($pdfPortraitPath);
        unlink($pdfLandscapePath);

        $fileName = $user->id . '.pdf';
        Storage::put('public/assessments/' . $fileName, $mergedPdf);

        return redirect(route('presentation.assessment', ['user' => $user->id]))
            ->with('success', 'Formulir Penilaian Pantia berhasil dibuat.');
    }
}
