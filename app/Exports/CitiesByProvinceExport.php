<?php

namespace App\Exports;

use App\Models\Province;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class CitiesByProvinceExport implements FromCollection, Responsable, WithCustomStartCell, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithTitle
{
    use Exportable;

    private $provinceId;
    private $search;

    public function __construct($provinceId, $search)
    {
        $this->provinceId = $provinceId;
        $this->search = $search;
    }

    public function collection()
    {
        $province = Province::with(['city'])->find($this->provinceId);
        $cities = $province->city;

        if (!empty($this->search)) {
            $loweredSearch = strtolower($this->search);

            $cities = $cities->filter(function ($city) use ($loweredSearch) {
                $isCityMatch = str_contains(strtolower($city->name), $loweredSearch);

                $isRelatedDataMatch = $city->mosque->contains(function ($mosque) use ($loweredSearch) {
                    return str_contains(strtolower($mosque->name), $loweredSearch) ||
                        str_contains(strtolower($mosque->user->name), $loweredSearch) ||
                        (isset($mosque->company->name) && str_contains(strtolower($mosque->company->name), $loweredSearch));
                });

                return $isCityMatch || $isRelatedDataMatch;
            });
        }

        $totalMosques = $cities->sum(function ($city) {
            return count($city->mosque);
        });

        $cities->push((object)[
            'name' => 'TOTAL',
            'mosque' => $totalMosques
        ]);

        return $cities;
    }

    public function startCell(): string
    {
        return 'B2';
    }

    public function map($city): array
    {
        return [
            $city->name,
            $city->name === 'TOTAL' ? $city->mosque : (count($city->mosque) > 0 ? count($city->mosque) : '-')
        ];
    }

    public function headings(): array
    {
        return [
            'KOTA/KABUPATEN',
            'JUMLAH',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('B1:C1');
        $sheet->setCellValue('B1', 'LAPORAN JUMLAH PESERTA PER KOTA');
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
        return 'Kota dan Kabupaten';
    }
}
