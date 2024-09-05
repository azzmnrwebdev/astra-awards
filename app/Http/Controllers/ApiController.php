<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getCities($provinceId)
    {
        $cities = City::where('province_id', $provinceId)->get();

        return response()->json($cities);
    }

    public function getCompanies(Request $request)
    {
        $businessLineId = $request->query('business_line_id');
        $parentCompanyId = $request->query('parent_company_id');

        $companies = Company::where('business_line_id', $businessLineId)
            ->where('parent_company_id', $parentCompanyId)
            ->get();

        return response()->json($companies);
    }
}
