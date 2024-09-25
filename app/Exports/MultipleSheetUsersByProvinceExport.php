<?php

namespace App\Exports;

use App\Models\Province;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultipleSheetUsersByProvinceExport implements WithMultipleSheets
{
    public $fileName;
    private $provinceId;
    private $search;

    public function __construct($provinceId, $search)
    {
        $this->provinceId = $provinceId;
        $this->search = $search;

        $province = Province::find($this->provinceId);
        $this->fileName = 'Daftar-Peserta-Provinsi-' . str_replace([' ', ','], ['-', ''], $province->name) . '.xlsx';
    }

    public function sheets(): array
    {
        return [
            new CitiesByProvinceExport($this->provinceId, $this->search),
            new UsersByProvinceExport($this->provinceId, $this->search),
        ];
    }
}
