<?php

namespace App\Exports;

use App\Models\BusinessLine;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\UsersByBusinessLineExport;
use App\Exports\CompaniesByBusinessLineExport;



class MultipleSheetCompaniesByBusinessLineExport implements WithMultipleSheets
{
    public $fileName;
    private $businessLineId;

    public function __construct($businessLineId)
    {
        $this->businessLineId = $businessLineId;

        $businessLine = BusinessLine::with(['company'])->find($this->businessLineId);
        $this->fileName = 'Daftar-Peserta-Lini-Bisnis-' . str_replace([' ', ','], ['-', ''], $businessLine->name) . '.xlsx';
    }

    public function sheets(): array
    {
        return [
            new CompaniesByBusinessLineExport($this->businessLineId),
            new UsersByBusinessLineExport($this->businessLineId),
        ];
    }
}
