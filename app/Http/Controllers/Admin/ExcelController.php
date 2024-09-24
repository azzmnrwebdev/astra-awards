<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
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

    public function getAllUsers(Request $request)
    {
        $companyId = $request->input('perusahaan');
        $status = $request->input('status');
        $search = $request->input('pencarian');

        return new UsersExport($companyId, $status, $search);
    }
}
