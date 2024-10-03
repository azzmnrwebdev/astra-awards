<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PreAssessmentsExport;
use App\Exports\UsersByCategoryExport;
use App\Exports\MultipleSheetUsersByProvinceExport;
use App\Exports\MultipleSheetCompaniesByBusinessLineExport;

class ExcelController extends Controller
{
    public function getUsersByProvince($provinceId, Request $request)
    {
        $search = $request->query('search');

        $export = new MultipleSheetUsersByProvinceExport($provinceId, $search);
        $fileName = $export->fileName;

        return Excel::download($export, $fileName);
    }

    public function getUsersByBusinessLine($businessLineId, Request $request)
    {
        $search = $request->query('search');

        $export = new MultipleSheetCompaniesByBusinessLineExport($businessLineId, $search);
        $fileName = $export->fileName;

        return Excel::download($export, $fileName);
    }

    public function getUsersByCategory($categoryAreaId, $categoryMosqueId, Request $request)
    {
        $search = $request->query('search');


        $export = new UsersByCategoryExport($categoryAreaId, $categoryMosqueId, $search);
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

    public function preeAssessments(Request $request)
    {
        $categoryAreaId = $request->input('kategori_area');
        $categoryMosqueId = $request->input('kategori_masjid');
        $search = $request->input('pencarian');

        return new PreAssessmentsExport($categoryAreaId, $categoryMosqueId, $search);
    }

    public function startAssessments(Request $request)
    {
        $categoryAreaId = $request->input('kategori_area');
        $categoryMosqueId = $request->input('kategori_masjid');
        $search = $request->input('pencarian');

        // return new PreAssessmentsExport($categoryAreaId, $categoryMosqueId, $search);
    }

    public function endAssessments(Request $request)
    {
        $categoryAreaId = $request->input('kategori_area');
        $categoryMosqueId = $request->input('kategori_masjid');
        $search = $request->input('pencarian');

        // return new PreAssessmentsExport($categoryAreaId, $categoryMosqueId, $search);
    }
}
