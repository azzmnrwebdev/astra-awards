<?php

namespace App\Exports;

use App\Models\BusinessLine;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class MultipleSheetCompaniesByBusinessLineExport implements WithMultipleSheets
{
    public $fileName;
    private $businessLineId;    
    private $search;

    public function __construct($businessLineId, $search)
    {
        $this->businessLineId = $businessLineId;
        $this->search = $search;

        $businessLine = BusinessLine::find($this->businessLineId);
        // $businessLine = BusinessLine::with(['company.mosque'])->find($this->businessLineId);
        $this->fileName = 'Daftar-Peserta-Lini-Bisnis-' . str_replace([' ', ','], ['-', ''], $businessLine->name) . '.xlsx';
    }

    public function sheets(): array
    {
        return [
            new CompaniesByBusinessLineExport($this->businessLineId, $this->search),
            new UsersByBusinessLineExport($this->businessLineId, $this->search),
        ];
    }
}
