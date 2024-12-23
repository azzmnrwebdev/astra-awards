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
    private $year;
    private $search;

    private $index = 0;

    private $title;
    private $fileName;

    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/xlsx',
    ];

    public function __construct($categoryAreaId = null, $categoryMosqueId = null, $juryId = null, $year = null, $search = null)
    {
        $currentYear = date('Y');

        $this->categoryAreaId = $categoryAreaId;
        $this->categoryMosqueId = $categoryMosqueId;
        $this->juryId = $juryId;
        $this->year = $year ?? $currentYear;
        $this->search = $search;

        $this->title = "LAPORAN PENILAIAN AKHIR AMALIAH ASTRA AWARDS $year";
        $this->fileName = "Laporan-Penilaian-Akhir-Peserta-Amaliah-Astra-Awards-$year.xlsx";

        if ($this->categoryAreaId && $this->categoryMosqueId) {
            $categoryArea = CategoryArea::find($this->categoryAreaId);
            $categoryMosque = CategoryMosque::find($this->categoryMosqueId);

            $this->title = "LAPORAN PENILAIAN AKHIR AMALIAH ASTRA AWARDS $year\n" .
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
                    'mosque.presentationWithCustomYear' => fn($query) => $query->where('year', $this->year),
                    'mosque.presentationWithCustomYear.startAssessmentWithCustomYear' => fn($query) => $query->where('year', $this->year),
                ])->whereHas('mosque', function ($q) use ($area, $mosque) {
                    $q->where('category_area_id', $area->id)->where('category_mosque_id', $mosque->id);
                })->when($this->categoryAreaId && $this->categoryMosqueId, function ($query) {
                    $query->whereHas('mosque', function ($q) {
                        $q->where('category_area_id', $this->categoryAreaId)
                            ->where('category_mosque_id', $this->categoryMosqueId);
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

                    $presentation = $user->mosque->presentationWithCustomYear;

                    if ($presentation && $presentation->startAssessmentWithCustomYear->isNotEmpty()) {
                        $totalPillarOne = $presentation->startAssessmentWithCustomYear->sum('presentation_file_pillar_one');
                        $totalPillarTwo = $presentation->startAssessmentWithCustomYear->sum('presentation_file_pillar_two');
                        $totalPillarThree = $presentation->startAssessmentWithCustomYear->sum('presentation_file_pillar_three');
                        $totalPillarFour = $presentation->startAssessmentWithCustomYear->sum('presentation_file_pillar_four');
                        $totalPillarFive = $presentation->startAssessmentWithCustomYear->sum('presentation_file_pillar_five');

                        $totalValue += $totalPillarOne * $weightPillarOne;
                        $totalValue += $totalPillarTwo * $weightPillarTwo;
                        $totalValue += $totalPillarThree * $weightPillarThree;
                        $totalValue += $totalPillarFour * $weightPillarFour;
                        $totalValue += $totalPillarFive * $weightPillarFive;

                        $juryCount = $presentation->startAssessmentWithCustomYear->count();

                        if ($juryCount > 0) {
                            $totalValue = $totalValue / $juryCount;
                        }
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

        if ($this->juryId) {
            // Status
            $status = 'Belum Penilaian';

            if ($user->mosque->endAssessmentForJuryWithCustomYear($this->juryId)->where('year', $this->year)->exists()) {
                $status = 'Sudah Penilaian';
            }

            // Pillar Assessments
            $pillarTwoValue = null;
            $pillarOneValue = null;
            $pillarThreeValue = null;
            $pillarFourValue = null;
            $pillarFiveValue = null;

            // TOtal & Rekap Nilai
            $totalValue = null;
            $recapValue = null;
            $assessment = $user->mosque
                ->endAssessmentForJuryWithCustomYear($this->juryId)
                ->where('year', $this->year)
                ->first();

            if ($assessment) {
                $pillarTwoValue += $assessment->presentation_value_pillar_two;
                $pillarOneValue += $assessment->presentation_value_pillar_one;
                $pillarThreeValue += $assessment->presentation_value_pillar_three;
                $pillarFourValue += $assessment->presentation_value_pillar_four;
                $pillarFiveValue += $assessment->presentation_value_pillar_five;

                // Total Nilai
                $totalValue  += $assessment->presentation_value_pillar_two +
                    $assessment->presentation_value_pillar_one +
                    $assessment->presentation_value_pillar_three +
                    $assessment->presentation_value_pillar_four +
                    $assessment->presentation_value_pillar_five;

                // Rekap Nilai
                $recapValue += $assessment->presentation_value_pillar_two * 0.25 +
                    $assessment->presentation_value_pillar_one * 0.25 +
                    $assessment->presentation_value_pillar_three * 0.2 +
                    $assessment->presentation_value_pillar_four * 0.15 +
                    $assessment->presentation_value_pillar_five * 0.15;
            }
        } else {
            // Status
            $status = 'Semua Juri Sudah Menilai';
            $totalJuries = User::where('role', 'jury')->count();

            $completedAssessments = $user->mosque->endAssessmentWithCustomYear()
                ->where('year', $this->year)
                ->distinct('jury_id')
                ->count('jury_id');

            if ($completedAssessments === 0) {
                $status = 'Juri Belum Menilai';
            } elseif ($completedAssessments < $totalJuries) {
                $status = 'Baru Sebagian Juri';
            }

            // Pillar Assessments
            $pillarTwoValue = null;
            $pillarOneValue = null;
            $pillarThreeValue = null;
            $pillarFourValue = null;
            $pillarFiveValue = null;

            $user->mosque->endAssessmentWithCustomYear->where('year', $this->year)->sum(function ($sumAssessment) use (&$pillarTwoValue) {
                $pillarTwoValue += $sumAssessment->presentation_value_pillar_two;
            });

            $user->mosque->endAssessmentWithCustomYear->where('year', $this->year)->sum(function ($sumAssessment) use (&$pillarOneValue) {
                $pillarOneValue += $sumAssessment->presentation_value_pillar_one;
            });

            $user->mosque->endAssessmentWithCustomYear->where('year', $this->year)->sum(function ($sumAssessment) use (&$pillarThreeValue) {
                $pillarThreeValue += $sumAssessment->presentation_value_pillar_three;
            });

            $user->mosque->endAssessmentWithCustomYear->where('year', $this->year)->sum(function ($sumAssessment) use (&$pillarFourValue) {
                $pillarFourValue += $sumAssessment->presentation_value_pillar_four;
            });

            $user->mosque->endAssessmentWithCustomYear->where('year', $this->year)->sum(function ($sumAssessment) use (&$pillarFiveValue) {
                $pillarFiveValue += $sumAssessment->presentation_value_pillar_five;
            });

            // Total Nilai
            $totalValue = null;
            $user->mosque->endAssessmentWithCustomYear->where('year', $this->year)->each(function ($sumAssessment) use (&$totalValue) {
                $totalValue += $sumAssessment->presentation_value_pillar_two +
                    $sumAssessment->presentation_value_pillar_one +
                    $sumAssessment->presentation_value_pillar_three +
                    $sumAssessment->presentation_value_pillar_four +
                    $sumAssessment->presentation_value_pillar_five;
            });

            // Rekap Nilai
            $recapValue = null;
            $user->mosque->endAssessmentWithCustomYear->where('year', $this->year)->each(function ($sumAssessment) use (&$recapValue) {
                $recapValue += $sumAssessment->presentation_value_pillar_two * 0.25 +
                    $sumAssessment->presentation_value_pillar_one * 0.25 +
                    $sumAssessment->presentation_value_pillar_three * 0.20 +
                    $sumAssessment->presentation_value_pillar_four * 0.15 +
                    $sumAssessment->presentation_value_pillar_five * 0.15;
            });
        }

        return [
            $this->index,
            $user->mosque->name,
            $user->mosque->company->name,
            $user->mosque->city->province->name,
            $user->mosque->categoryMosque->name,
            $user->mosque->categoryArea->name,
            $status,
            $pillarTwoValue ? $pillarTwoValue : '-',
            $pillarOneValue ? $pillarOneValue : '-',
            $pillarThreeValue ? $pillarThreeValue : '-',
            $pillarFourValue ? $pillarFourValue : '-',
            $pillarFiveValue ? $pillarFiveValue : '-',
            $totalValue ? $totalValue : '-',
            $recapValue ? number_format($recapValue, 2, ',', '') : '-'
        ];
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA MASJID/MUSALA',
            'PERUSAHAAN',
            'PROVINSI',
            'KATEGORI',
            'KATEGORI AREA',
            'STATUS',
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
        $sheet->mergeCells('B1:O1');
        $sheet->setCellValue('B1', "\n\n" . $this->title);
        $sheet->getRowDimension(1)->setRowHeight(100);

        $sheet->getStyle('B1:O1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B1:O1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM);

        if ($this->juryId) {
            $sheet->mergeCells('B2:O2');
            $sheet->setCellValue('B2', 'NAMA JURI                      :  ' . $this->juryName);
            $sheet->getRowDimension(2)->setRowHeight(20);

            $sheet->getRowDimension(3)->setRowHeight(100);

            $lastDataRow = $sheet->getHighestRow();
            for ($rowIndex = 4; $rowIndex <= $lastDataRow; $rowIndex++) {
                $sheet->getRowDimension($rowIndex)->setRowHeight(20);
                $sheet->getStyle('C' . $rowIndex . ':O' . $rowIndex)->getAlignment()->setIndent(1);
            }

            $sheet->getStyle('B3:O' . $lastDataRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            return [
                'B1:O1' => [
                    'font' => ['bold' => true, 'size' => 16, 'color' => ['argb' => 'FF000000']],
                    'alignment' => ['wrapText' => true],
                ],
                'B' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'B2:O2' => [
                    'font' => ['bold' => true],
                    'alignment' => ['horizontal' => 'left', 'wrapText' => true],
                ],
                'B3:O3' => [
                    'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'], 'uppercase' => true],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                    'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF004EA2']],
                ],
                'C' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'D' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'E' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'F' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'G' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'H' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'I' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'J' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'K' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'L' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'M' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'N' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'O' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            ];
        } else {
            $sheet->getRowDimension(2)->setRowHeight(100);

            $lastDataRow = $sheet->getHighestRow();
            for ($rowIndex = 3; $rowIndex <= $lastDataRow; $rowIndex++) {
                $sheet->getRowDimension($rowIndex)->setRowHeight(20);
                $sheet->getStyle('C' . $rowIndex . ':O' . $rowIndex)->getAlignment()->setIndent(1);
            }

            $sheet->getStyle('B2:O' . $lastDataRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            return [
                'B1:O1' => [
                    'font' => ['bold' => true, 'size' => 16, 'color' => ['argb' => 'FF000000']],
                    'alignment' => ['wrapText' => true],
                ],
                'B2:O2' => [
                    'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'], 'uppercase' => true],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                    'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF004EA2']],
                ],
                'B' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'C' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'D' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'E' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'F' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'G' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'H' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'I' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'J' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'K' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'L' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'M' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'N' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'O' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            ];
        }
    }

    public function title(): string
    {
        return 'Laporan Penilaian Akhir';
    }
}
