<?php

namespace App\Exports;

use App\Models\Mosque;
use App\Models\BusinessLine;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class UsersByBusinessLineExport implements FromCollection, Responsable, WithCustomStartCell, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithTitle
{
    use Exportable;

    private $index = 0;
    private $businessLineId;
    private $businessLineName;
    private $search;

    public function __construct($businessLineId, $search)
    {
        $this->businessLineId = $businessLineId;
        $this->search = $search;
        
        $businessLine = BusinessLine::find($this->businessLineId);
        $this->businessLineName = strtoupper($businessLine->name);

    }

    public function collection()
    {
        $mosques = Mosque::with(['user', 'company.businessLine'])
            ->whereHas('company.businessLine', function ($query) {
                $query->where('business_line_id', $this->businessLineId);
            });
        
        if (!empty($this->search)) {
            $mosques->where(function ($query) {
                $loweredSearch = strtolower($this->search);

                $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%'])
                    ->orWhereHas('user', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('company', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('company.businessLine', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    });
            });
        }

        return $mosques->get();

    }

    public function startCell(): string
    {
        return 'B2';
    }

    public function map($mosque): array
    {
        $this->index++;

        return [
            $this->index,
            $mosque->user->name,
            $mosque->name,
            $mosque->company->businessLine->name,
            $mosque->company->name,
        ];
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA PESERTA',
            'NAMA MASJID/MUSALA',
            'INDUK PERUSAHAAN',
            'PERUSAHAAN',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('B1:F1');
        $sheet->setCellValue('B1', 'LAPORAN PESERTA YANG SUDAH TERDAFTAR DI SISTEM BERDASARKAN LINI BISNIS, YAYASAN & KOPERASI, HEAD OFFICE ' . $this->businessLineName);
        $sheet->getRowDimension(1)->setRowHeight(50);

        $sheet->getRowDimension(2)->setRowHeight(30);
        $sheet->getStyle('C2:F2')->getAlignment()->setIndent(1);

        $lastDataRow = $sheet->getHighestRow();
        for ($rowIndex = 3; $rowIndex <= $lastDataRow; $rowIndex++) {
            $sheet->getRowDimension($rowIndex)->setRowHeight(20);
            $sheet->getStyle('C' . $rowIndex . ':F' . $rowIndex)->getAlignment()->setIndent(1);
        }

        $sheet->getStyle('B2:F' . $lastDataRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [
            'B1:F1' => [
                'font' => ['bold' => true, 'size' => 14, 'color' => ['argb' => 'FF000000']],
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
            ],
            'B2:F2' => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'], 'uppercase' => true],
                'alignment' => ['vertical' => 'center', 'wrapText' => true],
                'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF004EA2']],
            ],
            'B' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'C' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'D' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'E' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'F' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
        ];
    }

    public function title(): string
    {
        return 'Peserta';
    }
}
