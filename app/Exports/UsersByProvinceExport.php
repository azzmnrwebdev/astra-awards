<?php

namespace App\Exports;

use App\Models\Mosque;
use App\Models\Province;
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

class UsersByProvinceExport implements FromCollection, Responsable, WithCustomStartCell, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithTitle
{
    use Exportable;

    private $index = 0;
    private $provinceId;
    private $provinceName;
    private $search;

    public function __construct($provinceId, $search)
    {
        $this->provinceId = $provinceId;
        $this->search = $search;

        $province = Province::find($this->provinceId);
        $this->provinceName = strtoupper($province->name);
    }

    public function collection()
    {
        $mosques = Mosque::with(['user', 'city'])->whereHas('city', function ($query) {
            $query->where('province_id', $this->provinceId);
        });

        if (!empty($this->search)) {
            $mosques->where(function ($query) {
                $loweredSearch = strtolower($this->search);

                $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%'])
                    ->orWhereHas('user', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('company', function ($query) use ($loweredSearch) {
                        $query->whereRaw('LOWER(name) like ?', ['%' . $loweredSearch . '%']);
                    })->orWhereHas('city', function ($query) use ($loweredSearch) {
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
            $mosque->company->name,
            $mosque->name,
            $mosque->city->name,
        ];
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA PESERTA',
            'PERUSAHAAN',
            'NAMA MASJID/MUSALA',
            'KOTA/KABUPATEN',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('B1:F1');
        $sheet->setCellValue('B1', 'LAPORAN PESERTA YANG SUDAH TERDAFTAR DI SISTEM BERDASARKAN PROVINSI ' . $this->provinceName);
        $sheet->getRowDimension(1)->setRowHeight(40);

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
