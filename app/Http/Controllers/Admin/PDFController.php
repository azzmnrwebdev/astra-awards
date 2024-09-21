<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Carbon\Carbon;
use App\Models\Mosque;
use App\Models\Province;
use iio\libmergepdf\Merger;
use App\Http\Controllers\Controller;
use App\Models\BusinessLine;

class PDFController extends Controller
{
    public function getUsersByProvince($provinceId)
    {
        $province = Province::with(['city'])->findOrFail($provinceId);

        $mosques = Mosque::with(['user', 'city'])->whereHas('city', function ($query) use ($provinceId) {
            $query->where('province_id', $provinceId);
        })->get();

        $data = [
            'date' => Carbon::now()->toDateString(),
            'province' => $province,
            'mosques' => $mosques,
        ];

        $provinceName = str_replace(' ', '-', $province->name);

        $pdfPortrait = PDF::loadView('admin.pdf.users-by-province-cover', $data)
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

    public function getUsersByBusinessLine($businessLineId)
    {
        $businessLine = BusinessLine::with(['company'])->findOrFail($businessLineId);

        $mosques = Mosque::with(['user', 'company', 'company.businessLine', 'company.parentCompany'])->whereHas('company', function ($query) use ($businessLineId) {
            $query->where('business_line_id', $businessLineId);
        })->get();

        $data = [
            'date' => Carbon::now()->toDateString(),
            'businessLine' => $businessLine,
            'mosques' => $mosques,
        ];

        $businessLineName = str_replace(' ', '-', $businessLine->name);

        $pdfPortrait = PDF::loadView('admin.pdf.users-by-business-line-cover', $data)
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
}
