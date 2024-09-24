<?php

namespace App\Http\Controllers\Admin;

use App\Models\BusinessLine;
use App\Models\CategoryArea;
use App\Models\CategoryMosque;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersByCategoryExport;
use App\Exports\UsersByBusinessLineExport;
use App\Exports\MultipleSheetUsersByProvinceExport;

class ExcelController extends Controller
{
    public function getUsersByProvince($provinceId)
    {
        $export = new MultipleSheetUsersByProvinceExport($provinceId);
        $fileName = $export->fileName;

        return Excel::download($export, $fileName);
    }

    public function getUsersByBusinessLine($businessLineId)
    {
        $businessLine = BusinessLine::with(['company'])->find($businessLineId);

        $businessLineName = str_replace([' ', ','], ['-', ''], $businessLine->name);

        return Excel::download(new UsersByBusinessLineExport($businessLineId), 'Daftar-Peserta-Lini-Bisnis-' . $businessLineName . '.xlsx', \Maatwebsite\Excel\Excel::XLS);
    }

    public function getUsersByCategory($categoryAreaId, $categoryMosqueId)
    {
        $categoryArea = CategoryArea::find($categoryAreaId);
        $categoryMosque = CategoryMosque::find($categoryMosqueId);

        $categoryAreaName = str_replace([' ', ','], ['-', ''], $categoryArea->name);
        $categoryMosqueName = str_replace([' ', ','], ['-', ''], $categoryMosque->name);

        return Excel::download(new UsersByCategoryExport($categoryAreaId, $categoryMosqueId), 'Daftar-Peserta-Kategori-' . $categoryAreaName . '-dan-' . $categoryMosqueName . '.xlsx', \Maatwebsite\Excel\Excel::XLS);
    }
}
