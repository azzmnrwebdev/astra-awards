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
    private $statusForm;
    private $statusPresentationFile;
    private $search;

    private $index = 0;

    private $fileName;
    private $currentYear;

    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/xlsx',
    ];

    public function __construct($companyId = null, $statusAccount = null, $statusForm = null, $statusPresentationFile = null, $search = null)
    {
        $this->currentYear = date('Y');

        $this->companyId = $companyId;
        $this->statusAccount = $statusAccount;
        $this->statusForm = $statusForm;
        $this->statusPresentationFile = $statusPresentationFile;
        $this->search = $search;

        $this->fileName = "Daftar-Peserta-Amaliah-Astra-Awards-{$this->currentYear}.xlsx";
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

        if ($this->statusForm !== null) {
            if ($this->statusForm === "belum") {
                $query->where(function ($q) {
                    $q->whereDoesntHave('mosque.pillarOne')
                        ->whereDoesntHave('mosque.pillarTwo')
                        ->whereDoesntHave('mosque.pillarThree')
                        ->whereDoesntHave('mosque.pillarFour')
                        ->whereDoesntHave('mosque.pillarFive');
                });
            }

            if ($this->statusForm === "sebagian") {
                $query->where(function ($q) {
                    $q->whereHas('mosque.pillarOne', function ($q1) {
                        $q1->where(function ($q2) {
                            $q2->whereNotNull('question_one')
                                ->orWhereNotNull('question_two')
                                ->orWhereNotNull('question_three')
                                ->orWhereNotNull('question_four')
                                ->orWhereNotNull('question_five')
                                ->orWhereNotNull('file_question_two_one')
                                ->orWhereNotNull('file_question_two_two');
                        });
                    })->orWhereHas('mosque.pillarTwo', function ($q1) {
                        $q1->where(function ($q2) {
                            $q2->whereNotNull('question_two')
                                ->orWhereNotNull('question_three')
                                ->orWhereNotNull('question_four')
                                ->orWhereNotNull('question_five');
                        });
                    })->orWhereHas('mosque.pillarThree', function ($q1) {
                        $q1->where(function ($q2) {
                            $q2->whereNotNull('question_one')
                                ->orWhereNotNull('question_two')
                                ->orWhereNotNull('question_three')
                                ->orWhereNotNull('question_four')
                                ->orWhereNotNull('question_five')
                                ->orWhereNotNull('question_six');
                        });
                    })->orWhereHas('mosque.pillarFour', function ($q1) {
                        $q1->where(function ($q2) {
                            $q2->whereNotNull('question_one')
                                ->orWhereNotNull('question_two')
                                ->orWhereNotNull('question_three')
                                ->orWhereNotNull('question_four')
                                ->orWhereNotNull('question_five');
                        });
                    })->orWhereHas('mosque.pillarFive', function ($q1) {
                        $q1->where(function ($q2) {
                            $q2->whereNotNull('question_one')
                                ->orWhereNotNull('question_two')
                                ->orWhereNotNull('question_three')
                                ->orWhereNotNull('question_four')
                                ->orWhereNotNull('question_five');
                        });
                    });
                })->where(function ($q) {
                    $q->whereDoesntHave('mosque.pillarOne', function ($q1) {
                        $q1->whereNotNull('question_one')
                            ->whereNotNull('question_two')
                            ->whereNotNull('question_three')
                            ->whereNotNull('question_four')
                            ->whereNotNull('question_five')
                            ->whereNotNull('file_question_two_one')
                            ->whereNotNull('file_question_two_two');
                    })->orWhereDoesntHave('mosque.pillarTwo', function ($q1) {
                        $q1->whereNotNull('question_two')
                            ->whereNotNull('question_three')
                            ->whereNotNull('question_four')
                            ->whereNotNull('question_five');
                    })->orWhereDoesntHave('mosque.pillarThree', function ($q1) {
                        $q1->whereNotNull('question_one')
                            ->whereNotNull('question_two')
                            ->whereNotNull('question_three')
                            ->whereNotNull('question_four')
                            ->whereNotNull('question_five')
                            ->whereNotNull('question_six');
                    })->orWhereDoesntHave('mosque.pillarFour', function ($q1) {
                        $q1->whereNotNull('question_one')
                            ->whereNotNull('question_two')
                            ->whereNotNull('question_three')
                            ->whereNotNull('question_four')
                            ->whereNotNull('question_five');
                    })->orWhereDoesntHave('mosque.pillarFive', function ($q1) {
                        $q1->whereNotNull('question_one')
                            ->whereNotNull('question_two')
                            ->whereNotNull('question_three')
                            ->whereNotNull('question_four')
                            ->whereNotNull('question_five');
                    });
                });
            }

            if ($this->statusForm === "lengkap") {
                $query->whereHas('mosque.pillarOne', function ($q1) {
                    $q1->where(function ($q2) {
                        $q2->whereNotNull('question_one')
                            ->whereNotNull('question_two')
                            ->whereNotNull('question_three')
                            ->whereNotNull('question_four')
                            ->whereNotNull('question_five')
                            ->whereNotNull('file_question_two_one')
                            ->whereNotNull('file_question_two_two');
                    });
                })->whereHas('mosque.pillarTwo', function ($q1) {
                    $q1->where(function ($q2) {
                        $q2->whereNotNull('question_two')
                            ->whereNotNull('question_three')
                            ->whereNotNull('question_four')
                            ->whereNotNull('question_five');
                    });
                })->whereHas('mosque.pillarThree', function ($q1) {
                    $q1->where(function ($q2) {
                        $q2->whereNotNull('question_one')
                            ->whereNotNull('question_two')
                            ->whereNotNull('question_three')
                            ->whereNotNull('question_four')
                            ->whereNotNull('question_five')
                            ->whereNotNull('question_six');
                    });
                })->whereHas('mosque.pillarFour', function ($q1) {
                    $q1->where(function ($q2) {
                        $q2->whereNotNull('question_one')
                            ->whereNotNull('question_two')
                            ->whereNotNull('question_three')
                            ->whereNotNull('question_four')
                            ->whereNotNull('question_five');
                    });
                })->whereHas('mosque.pillarFive', function ($q1) {
                    $q1->where(function ($q2) {
                        $q2->whereNotNull('question_one')
                            ->whereNotNull('question_two')
                            ->whereNotNull('question_three')
                            ->whereNotNull('question_four')
                            ->whereNotNull('question_five');
                    });
                });
            }
        }

        if ($this->statusPresentationFile !== null) {
            if ($this->statusPresentationFile === "belum") {
                $query->where(function ($q) {
                    $q->whereDoesntHave('mosque.presentation');
                });
            }

            if ($this->statusPresentationFile === "sudah") {
                $query->whereHas('mosque.presentation', function ($q1) {
                    $q1->where(function ($q2) {
                        $q2->whereNotNull('file');
                    });
                });
            }
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
        $sheet->setCellValue('B1', "\n\n" . 'LAPORAN SEMUA PESERTA PENDAFTAR AMALIAH ASTRA AWARDS ' . $this->currentYear);
        $sheet->getRowDimension(1)->setRowHeight(100);

        $sheet->getStyle('B1:T1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B1:T1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM);

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
                'font' => ['bold' => true, 'size' => 16, 'color' => ['argb' => 'FF000000']],
                'alignment' => ['wrapText' => true],
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
