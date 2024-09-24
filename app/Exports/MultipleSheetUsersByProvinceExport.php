<?php

namespace App\Exports;

use App\Models\Province;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultipleSheetUsersByProvinceExport implements WithMultipleSheets
{
    public $fileName;
    private $provinceId;

    public function __construct($provinceId)
    {
        $this->provinceId = $provinceId;

        $province = Province::find($this->provinceId);
        $this->fileName = 'Daftar-Peserta-Provinsi-' . str_replace([' ', ','], ['-', ''], $province->name) . '.xlsx';
    }

    public function sheets(): array
    {
        return [
            new CitiesByProvinceExport($this->provinceId),
            new UsersByProvinceExport($this->provinceId),
        ];
    }
}
