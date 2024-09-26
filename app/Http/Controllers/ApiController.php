<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use App\Models\Mosque;
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
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($companies);
    }

    public function getUsersByProvince($provinceId)
    {
        $search = request()->query('search');

        $query = Mosque::with(['user', 'company', 'city'])->whereHas('city', function ($query) use ($provinceId) {
            $query->where('province_id', $provinceId);
        });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $loweredSearch = strtolower($search);

                $q->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%'])
                    ->orWhereHas('user', function ($q2) use ($loweredSearch) {
                        $q2->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('company', function ($q3) use ($loweredSearch) {
                        $q3->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('city', function ($q4) use ($loweredSearch) {
                        $q4->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    });
            });
        }

        $mosques = $query->get();

        return response()->json($mosques);
    }

    public function getUsersByBusinessLine($businessLineId)
    {
        $search = request()->query('search');

        $query = Mosque::with(['user', 'company', 'company.businessLine', 'company.parentCompany'])->whereHas('company', function ($query) use ($businessLineId) {
            $query->where('business_line_id', $businessLineId);
        });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $loweredSearch = strtolower($search);

                $q->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%'])
                    ->orWhereHas('user', function ($q2) use ($loweredSearch) {
                        $q2->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('company', function ($q3) use ($loweredSearch) {
                        $q3->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('company.businessLine', function ($q4) use ($loweredSearch) {
                        $q4->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    });
            });
        }

        $mosques = $query->get();

        return response()->json($mosques);
    }

    public function getUsersByCategory($categoryAreaId, $categoryMosqueId)
    {
        $search = request()->query('search');

        $mosques = Mosque::with(['user', 'company', 'categoryArea', 'categoryMosque'])
            ->where('category_area_id', $categoryAreaId)
            ->where('category_mosque_id', $categoryMosqueId)
            ->get();

        return response()->json($mosques);
    }
}
