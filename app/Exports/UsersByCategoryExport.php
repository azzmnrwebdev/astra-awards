<?php

namespace App\Exports;

use App\Models\Mosque;
use App\Models\CategoryMosque;
use App\Models\CategoryArea;
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

class UsersByCategoryExport implements FromCollection, Responsable, WithCustomStartCell, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithTitle
{
    use Exportable;

    private $index = 0;
    private $categoryAreaId;
    private $categoryMosqueId;
    private $categoryAreaName;
    private $categoryMosqueName;
    private $search;

    public function __construct($categoryAreaId, $categoryMosqueId, $search)
    {
        $this->categoryMosqueId = $categoryMosqueId;
        $this->categoryAreaId = $categoryAreaId;
        $this->search = $search;
    
        $categoryMosque = CategoryMosque::find($this->categoryMosqueId);
        if ($categoryMosque) {
            $this->categoryMosqueName = strtoupper($categoryMosque->name);
        } else {
            $this->categoryMosqueName = 'UNKNOWN CATEGORY'; // Handle null case
        }
    
        $categoryArea = CategoryArea::find($this->categoryAreaId);
        if ($categoryArea) {
            $this->categoryAreaName = strtoupper($categoryArea->name);
        } else {
            $this->categoryAreaName = 'UNKNOWN AREA'; // Handle null case
        }
    }

    public $fileName = 'users_by_category.xlsx';

    public function collection()
    {
        $mosques = Mosque::with(['user', 'categoryArea'])->whereHas('categoryArea', function ($query) {
                $query->where('category_mosque_id', $this->categoryMosqueId);
            });

        if (!empty($this->search)) {
            $mosques->where(function ($query) {
                $loweredSearch = strtolower($this->search);

                $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%'])
                    ->orWhereHas('user', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('company', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('categoryArea', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('categoryMosque', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    });
            });

            return $mosques->get();

        }
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
            $mosque->company->name,
            $mosque->name,
            $mosque->categoryArea->name,
            $mosque->categoryMosque->name,
        ];
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA PESERTA',
            'PERUSAHAAN',
            'NAMA MASJID/MUSALA',
            'KATEGORI AREA',
            'KATEGORI MASJID',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('B1:G1');
        $sheet->setCellValue('B1', 'LAPORAN PESERTA YANG SUDAH TERDAFTAR DI SISTEM BERDASARKAN KATEGORI ' . $this->categoryAreaName . ' DAN ' . $this->categoryMosqueName);
        $sheet->getRowDimension(1)->setRowHeight(40);

        $sheet->getRowDimension(2)->setRowHeight(30);
        $sheet->getStyle('C2:G2')->getAlignment()->setIndent(1);

        $lastDataRow = $sheet->getHighestRow();
        for ($rowIndex = 3; $rowIndex <= $lastDataRow; $rowIndex++) {
            $sheet->getRowDimension($rowIndex)->setRowHeight(20);
            $sheet->getStyle('C' . $rowIndex . ':G' . $rowIndex)->getAlignment()->setIndent(1);
        }

        $sheet->getStyle('B2:G' . $lastDataRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [
            'B1:G1' => [
                'font' => ['bold' => true, 'size' => 14, 'color' => ['argb' => 'FF000000']],
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
            ],
            'B2:G2' => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'], 'uppercase' => true],
                'alignment' => ['vertical' => 'center', 'wrapText' => true],
                'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF004EA2']],
            ],
            'B' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'C' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'D' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'E' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'F' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'G' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
        ];
    }

    public function title(): string
    {
        return 'Peserta';
    }
}
