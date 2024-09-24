<?php

namespace App\Http\Controllers\Admin;

use App\Models\BusinessLine;
use App\Models\CategoryArea;
use App\Exports\UsersExport;
use App\Models\CategoryMosque;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersByCategoryExport;
use App\Exports\MultipleSheetUsersByProvinceExport;
use App\Exports\MultipleSheetCompaniesByBusinessLineExport;

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
        $export = new MultipleSheetCompaniesByBusinessLineExport($businessLineId);
        $fileName = $export->fileName;

        return Excel::download($export, $fileName);
    }

    public function getUsersByCategory($categoryAreaId, $categoryMosqueId)
    {
        $export = new UsersByCategoryExport($categoryAreaId, $categoryMosqueId);
        $fileName = $export->fileName;

        return Excel::download($export, $fileName);
    }

    public function getAllUsers()
    {
        return new UsersExport();
    }
}
