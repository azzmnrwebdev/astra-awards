<?php

namespace App\Exports;

use App\Models\Mosque;
use App\Models\BusinessLine;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Support\Responsable;

class CompaniesByBusinessLineExport implements FromCollection, Responsable, WithCustomStartCell, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithTitle
{
    use Exportable;

    private $businesslineId;

    public function __construct($businesslineId)
    {
        $this->businesslineId = $businesslineId;
    }

    public function collection()
    {
        $businessline = BusinessLine::with(['company'])->find($this->businesslineId);
        $companies = $businessline->company;

        $totalMosques = $companies->sum(function ($companies) {
            return count($companies->mosque);
        });

        $companies->push((object)[
            'name' => 'TOTAL',
            'mosque' => $totalMosques
        ]);

        return $companies;
    }

    public function startCell(): string
    {
        return 'B2';
    }

    public function map($company): array
    {
        return [
            $company->name,
            $company->name === 'TOTAL' ? $company->mosque : (count($company->mosque) > 0 ? count($company->mosque) : '-')
        ];
    }



    public function headings(): array
    {
        return [
            'PERUSAHAAN',
            'JUMLAH',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('B1:C1');
        $sheet->setCellValue('B1', 'LAPORAN JUMLAH PESERTA PER PERUSAHAAN');
        $sheet->getRowDimension(1)->setRowHeight(40);

        $sheet->getRowDimension(2)->setRowHeight(30);
        $sheet->getStyle('B2:C2')->getAlignment()->setIndent(1);

        $lastDataRow = $sheet->getHighestRow();
        for ($rowIndex = 3; $rowIndex <= $lastDataRow; $rowIndex++) {
            $sheet->getRowDimension($rowIndex)->setRowHeight(20);
            $sheet->getStyle('B' . $rowIndex . ':C' . $rowIndex)->getAlignment()->setIndent(1);
        }

        $sheet->getStyle("B{$lastDataRow}")->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getStyle('B2:C' . $lastDataRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [
            'B1:C1' => [
                'font' => ['bold' => true, 'size' => 14, 'color' => ['argb' => 'FF000000']],
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
            ],
            'B2:C2' => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'], 'uppercase' => true],
                'alignment' => ['vertical' => 'center', 'wrapText' => true],
                'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF004EA2']],
            ],
            'C2' => ['alignment' => ['horizontal' => 'center']],

            'B' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'C' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
        ];
    }

    public function title(): string
    {
        return 'Perusahaan';
    }
}