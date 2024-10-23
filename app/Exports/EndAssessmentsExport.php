<?php

namespace App\Exports;

use App\Models\CategoryArea;
use App\Models\CategoryMosque;
use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EndAssessmentsExport implements FromCollection, Responsable, WithCustomStartCell, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithTitle
{
    use Exportable;

    private $categoryAreaId;
    private $categoryMosqueId;
    private $juryId;
    private $juryName;
    private $search;

    private $index = 0;

    private $title = 'LAPORAN PENILAIAN AKHIR AMALIAH ASTRA AWARDS 2024';
    private $fileName = 'Daftar-Penilaian-Akhir-Peserta-Amaliah-Astra-Awards-2024.xlsx';

    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/xlsx',
    ];

    public function __construct($categoryAreaId = null, $categoryMosqueId = null, $juryId = null, $search = null)
    {
        $this->categoryAreaId = $categoryAreaId;
        $this->categoryMosqueId = $categoryMosqueId;
        $this->juryId = $juryId;
        $this->search = $search;

        if ($this->categoryAreaId && $this->categoryMosqueId) {
            $categoryArea = CategoryArea::find($this->categoryAreaId);
            $categoryMosque = CategoryMosque::find($this->categoryMosqueId);

            $this->title = "LAPORAN PENILAIAN AKHIR AMALIAH ASTRA AWARDS 2024\n" .
                "BERDASARKAN KATEGORI " . strtoupper($categoryArea->name) . " DAN " . strtoupper($categoryMosque->name);
        }

        if ($this->juryId) {
            $juryName = User::find($this->juryId);
            $this->juryName = strtoupper($juryName->name);
        }
    }

    public function collection()
    {
        $allUsers = collect();

        $categoryAreas = CategoryArea::all();
        $categoryMosques = CategoryMosque::all();

        foreach ($categoryAreas as $area) {
            foreach ($categoryMosques as $mosque) {
                $users = User::with([
                    'mosque',
                    'mosque.company',
                    'mosque.endAssessment'
                ])->whereHas('mosque', function ($q) use ($area, $mosque) {
                    $q->where('category_area_id', $area->id)->where('category_mosque_id', $mosque->id);
                })->when($this->categoryAreaId && $this->categoryMosqueId, function ($query) {
                    $query->whereHas('mosque', function ($q) {
                        $q->where('category_area_id', $this->categoryAreaId)
                            ->where('category_mosque_id', $this->categoryMosqueId);
                    });
                })->when($this->juryId, function ($query) {
                    $query->whereHas('mosque.endAssessment', function ($q) {
                        $q->where('jury_id', $this->juryId);
                    });
                })->when($this->search, function ($query) {
                    $query->where(function ($q) {
                        $q->whereHas('mosque', function ($mosqueQuery) {
                            $mosqueQuery->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->search) . '%']);
                        })->orWhereHas('mosque.company', function ($companyQuery) {
                            $companyQuery->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->search) . '%']);
                        });
                    });
                })->get();

                $users = $users->map(function ($user) {
                    $totalValue = 0;

                    $weightPillarOne = 0.25;
                    $weightPillarTwo = 0.25;
                    $weightPillarThree = 0.20;
                    $weightPillarFour = 0.15;
                    $weightPillarFive = 0.15;

                    if ($user->mosque->endAssessment) {
                        $totalValue += $user->mosque->endAssessment->presentation_value_pillar_two * $weightPillarTwo;
                        $totalValue += $user->mosque->endAssessment->presentation_value_pillar_one * $weightPillarOne;
                        $totalValue += $user->mosque->endAssessment->presentation_value_pillar_three * $weightPillarThree;
                        $totalValue += $user->mosque->endAssessment->presentation_value_pillar_four * $weightPillarFour;
                        $totalValue += $user->mosque->endAssessment->presentation_value_pillar_five * $weightPillarFive;
                    }

                    $user->totalNilai = $totalValue;

                    return $user;
                })->filter(function ($user) {
                    return $user->totalNilai > 0;
                });

                $allUsers = $allUsers->merge($users->sortByDesc('totalNilai'));
            }
        }

        return $allUsers;
    }

    public function startCell(): string
    {
        if ($this->juryId) {
            return 'B3';
        } else {
            return 'B2';
        }
    }

    public function map($user): array
    {
        $this->index++;

        $pillarTwoValue = $user->mosque->endAssessment->presentation_value_pillar_one;
        $pillarOneValue = $user->mosque->endAssessment->presentation_value_pillar_two;
        $pillarThreeValue = $user->mosque->endAssessment->presentation_value_pillar_three;
        $pillarFourValue = $user->mosque->endAssessment->presentation_value_pillar_four;
        $pillarFiveValue = $user->mosque->endAssessment->presentation_value_pillar_five;

        $pillarOneWeight = 0.25;
        $pillarTwoWeight = 0.25;
        $pillarThreeWeight = 0.20;
        $pillarFourWeight = 0.15;
        $pillarFiveWeight = 0.15;

        $rekapNilai = 0;

        if (is_numeric($pillarOneValue)) {
            $rekapNilai += $pillarOneValue * $pillarOneWeight;
        }

        if (is_numeric($pillarTwoValue)) {
            $rekapNilai += $pillarTwoValue * $pillarTwoWeight;
        }

        if (is_numeric($pillarThreeValue)) {
            $rekapNilai += $pillarThreeValue * $pillarThreeWeight;
        }

        if (is_numeric($pillarFourValue)) {
            $rekapNilai += $pillarFourValue * $pillarFourWeight;
        }

        if (is_numeric($pillarFiveValue)) {
            $rekapNilai += $pillarFiveValue * $pillarFiveWeight;
        }

        return [
            $this->index,
            $user->mosque->name,
            $user->mosque->company->name,
            $user->mosque->categoryMosque->name,
            $user->mosque->categoryArea->name,
            $pillarTwoValue,
            $pillarOneValue,
            $pillarThreeValue,
            $pillarFourValue,
            $pillarFiveValue,
            $user->totalNilai,
            $rekapNilai,
        ];
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA MASJID/MUSALA',
            'PERUSAHAAN',
            'KATEGORI',
            'KATEGORI AREA',
            "HUBUNGAN DENGAN\nYAYASAN AMALIAH\nASTRA (BOBOT 25%)",
            "HUBUNGAN\nMANAJEMEN\nPERUSAHAAN\nDENGAN DKM &\nJAMAAH (BOBOT 25%)",
            "PROGRAM SOSIAL\n(BOBOT 20%)",
            "ADMINISTRASI\n& KEUANGAN\n(BOBOT 15%)",
            "PERIBADAHAN\n& INFRASTRUKTUR\n(BOBOT 15%)",
            'TOTAL NILAI',
            "REKAP NILAI\n(DIKALIKAN BOBOT)",
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('B1:M1');
        $sheet->setCellValue('B1', "\n\n" . $this->title);
        $sheet->getRowDimension(1)->setRowHeight(100);

        $sheet->getStyle('B1:M1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B1:M1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM);

        if ($this->juryId) {
            $sheet->mergeCells('B2:M2');
            $sheet->setCellValue('B2', 'NAMA JURI                      :  ' . $this->juryName);
            $sheet->getRowDimension(2)->setRowHeight(20);

            $sheet->getRowDimension(3)->setRowHeight(100);

            $lastDataRow = $sheet->getHighestRow();
            for ($rowIndex = 4; $rowIndex <= $lastDataRow; $rowIndex++) {
                $sheet->getRowDimension($rowIndex)->setRowHeight(20);
                $sheet->getStyle('C' . $rowIndex . ':M' . $rowIndex)->getAlignment()->setIndent(1);
            }

            $sheet->getStyle('B3:M' . $lastDataRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            return [
                'B1:M1' => [
                    'font' => ['bold' => true, 'size' => 16, 'color' => ['argb' => 'FF000000']],
                    'alignment' => ['wrapText' => true],
                ],
                'B' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'B2:M2' => [
                    'font' => ['bold' => true],
                    'alignment' => ['horizontal' => 'left', 'wrapText' => true],
                ],
                'G' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'H' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'I' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'J' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'K' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'B3:M3' => [
                    'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'], 'uppercase' => true],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                    'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF004EA2']],
                ],
                'C' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'D' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'E' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'F' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'L' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'M' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            ];
        } else {
            $sheet->getRowDimension(2)->setRowHeight(100);

            $lastDataRow = $sheet->getHighestRow();
            for ($rowIndex = 3; $rowIndex <= $lastDataRow; $rowIndex++) {
                $sheet->getRowDimension($rowIndex)->setRowHeight(20);
                $sheet->getStyle('C' . $rowIndex . ':M' . $rowIndex)->getAlignment()->setIndent(1);
            }

            $sheet->getStyle('B2:M' . $lastDataRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            return [
                'B1:M1' => [
                    'font' => ['bold' => true, 'size' => 16, 'color' => ['argb' => 'FF000000']],
                    'alignment' => ['wrapText' => true],
                ],
                'G' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'H' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'I' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'J' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'K' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'B2:M2' => [
                    'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'], 'uppercase' => true],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                    'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF004EA2']],
                ],
                'B' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'C' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'D' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'E' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'F' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'L' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'M' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            ];
        }
    }

    public function title(): string
    {
        return 'Penilaian Akhir';
    }
}
