<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EndAssessmentRecapExport;
use App\Exports\EndAssessmentsExport;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PreAssessmentsExport;
use App\Exports\UsersByCategoryExport;
use App\Exports\MultipleSheetUsersByProvinceExport;
use App\Exports\MultipleSheetCompaniesByBusinessLineExport;
use App\Exports\StartAssessmentRecapExport;
use App\Exports\StartAssessmentsExport;

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
        $statusAccount = $request->input('status_akun');
        $statusForm = $request->input('status_formulir');
        $statusPresentationFile = $request->input('status_file_presentasi');
        $search = $request->input('pencarian');

        return new UsersExport($companyId, $statusAccount, $statusForm, $statusPresentationFile, $search);
    }

    public function preeAssessments(Request $request)
    {
        $categoryAreaId = $request->input('kategori_area');
        $categoryMosqueId = $request->input('kategori_masjid');
        $committeId = $request->input('panitia');
        $year = $request->input('tahun');
        $search = $request->input('pencarian');

        return new PreAssessmentsExport($categoryAreaId, $categoryMosqueId, $committeId, $year, $search);
    }

    public function startAssessments(Request $request)
    {
        $categoryAreaId = $request->input('kategori_area');
        $categoryMosqueId = $request->input('kategori_masjid');
        $juryId = $request->input('juri');
        $year = $request->input('tahun');
        $search = $request->input('pencarian');

        return new StartAssessmentsExport($categoryAreaId, $categoryMosqueId, $juryId, $year, $search);
    }

    public function startAssessmentRecapies(Request $request)
    {
        $categoryAreaId = $request->input('kategori_area');
        $categoryMosqueId = $request->input('kategori_masjid');
        $year = $request->input('tahun');
        $search = $request->input('pencarian');

        return new StartAssessmentRecapExport($categoryAreaId, $categoryMosqueId, $year, $search);
    }

    public function endAssessments(Request $request)
    {
        $categoryAreaId = $request->input('kategori_area');
        $categoryMosqueId = $request->input('kategori_masjid');
        $juryId = $request->input('juri');
        $year = $request->input('tahun');
        $search = $request->input('pencarian');

        return new EndAssessmentsExport($categoryAreaId, $categoryMosqueId, $juryId, $year, $search);
    }

    public function endAssessmentRecapies(Request $request)
    {
        $categoryAreaId = $request->input('kategori_area');
        $categoryMosqueId = $request->input('kategori_masjid');
        $year = $request->input('tahun');
        $search = $request->input('pencarian');

        return new EndAssessmentRecapExport($categoryAreaId, $categoryMosqueId, $year, $search);
    }
}
