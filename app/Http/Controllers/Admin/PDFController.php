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
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function getUsersByCategory($categoryAreaId, $categoryMosqueId)
    {
        $categoryArea = CategoryArea::find($categoryAreaId);
        $categoryMosque = CategoryMosque::find($categoryMosqueId);

        $mosques = Mosque::with(['user', 'company', 'categoryArea', 'categoryMosque'])
            ->where('category_area_id', $categoryAreaId)
            ->where('category_mosque_id', $categoryMosqueId)
            ->get();

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

    public function getUsersByBusinessLine($businessLineId)
    {
        $businessLine = BusinessLine::with(['company'])->find($businessLineId);

        $mosques = Mosque::with(['user', 'company', 'company.businessLine', 'company.parentCompany'])->whereHas('company', function ($query) use ($businessLineId) {
            $query->where('business_line_id', $businessLineId);
        })->get();

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
}
