<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, Responsable, WithCustomStartCell, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithTitle
{
    use Exportable;

    private $companyId;
    private $statusAccount;
    private $search;

    private $index = 0;

    private $fileName = 'Daftar-Peserta-Amaliah-Astra-Awards-2024.xlsx';

    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/xlsx',
    ];

    public function __construct($companyId = null, $statusAccount = null, $search = null)
    {
        $this->companyId = $companyId;
        $this->statusAccount = $statusAccount;
        $this->search = $search;
    }

    public function collection()
    {
        $query =  User::with([
            'mosque',
            'mosque.categoryMosque',
            'mosque.categoryArea',
            'mosque.company',
            'mosque.company.parentCompany',
            'mosque.company.businessLine',
            'mosque.city',
            'mosque.city.province',
        ])->where('role', 'user');

        if ($this->companyId) {
            $query->whereHas('mosque', function ($q) {
                $q->where('company_id', $this->companyId);
            });
        }

        if ($this->statusAccount !== null) {
            $query->where('status', (int)$this->statusAccount);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->whereRaw('LOWER(users.name) LIKE ?', ['%' . strtolower($this->search) . '%'])
                    ->orWhereRaw('LOWER(users.phone_number) LIKE ?', ['%' . strtolower($this->search) . '%'])
                    ->orWhereHas('mosque.company', function ($q2) {
                        $q2->whereRaw('LOWER(companies.name) LIKE ?', ['%' . strtolower($this->search) . '%']);
                    });
            });
        }

        return $query->get();
    }

    public function startCell(): string
    {
        return 'B2';
    }

    public function map($user): array
    {
        $this->index++;

        return [
            $this->index,
            $user->name,
            $user->email,
            $user->phone_number,
            $user->mosque->position,
            $user->status == 1 ? 'Aktif' : 'Tidak Aktif',
            $user->mosque->name,
            $user->mosque->categoryMosque->name,
            $user->mosque->capacity,
            $user->mosque->leader,
            $user->mosque->leader_email,
            $user->mosque->leader_phone,
            $user->mosque->categoryArea->name,
            $user->mosque->company->name,
            $user->mosque->company->parentCompany->name,
            $user->mosque->company->businessLine->name,
            $user->mosque->city->province->name,
            $user->mosque->city->name,
            $user->mosque->address,
        ];
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA LENGKAP',
            'ALAMAT EMAIL',
            'NOMOR PONSEL',
            'JABATAN',
            'STATUS AKUN',
            'NAMA MASJID/MUSALA',
            'KATEGORI MASJID/MUSALA',
            'KAPASITAS JAMAAH',
            'KETUA PENGURUS',
            'EMAIL KETUA',
            'NOMOR PONSEL KETUA',
            'KATEGORI AREA',
            'PERUSAHAAN',
            'INDUK PERUSAHAAN',
            'LINI BISNIS',
            'PROVINSI',
            'KOTA/KABUPATEN',
            'ALAMAT',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('B1:T1');
        $sheet->setCellValue('B1', 'LAPORAN SEMUA PESERTA PENDAFTAR AMALIAH ASTRA AWARDS 2024');
        $sheet->getRowDimension(1)->setRowHeight(40);

        $sheet->getRowDimension(2)->setRowHeight(30);
        $sheet->getStyle('C2:T2')->getAlignment()->setIndent(1);

        $lastDataRow = $sheet->getHighestRow();
        for ($rowIndex = 3; $rowIndex <= $lastDataRow; $rowIndex++) {
            $sheet->getRowDimension($rowIndex)->setRowHeight(20);
            $sheet->getStyle('C' . $rowIndex . ':T' . $rowIndex)->getAlignment()->setIndent(1);
        }

        $sheet->getStyle('B2:T' . $lastDataRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [
            'B1:T1' => [
                'font' => ['bold' => true, 'size' => 14, 'color' => ['argb' => 'FF000000']],
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
            ],
            'B2:T2' => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'], 'uppercase' => true],
                'alignment' => ['vertical' => 'center', 'wrapText' => true],
                'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF004EA2']],
            ],
            'B' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'C' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'D' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'E' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'F' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'G' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'H' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'I' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'J' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
            'J2' => ['alignment' => ['horizontal' => 'center']],
            'K' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'L' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'M' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'N' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'O' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'P' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'Q' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'R' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'S' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'T' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
        ];
    }

    public function title(): string
    {
        return 'Peserta';
    }
}
