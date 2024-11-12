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

class StartAssessmentsExport implements FromCollection, Responsable, WithCustomStartCell, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithTitle
{
    use Exportable;

    private $categoryAreaId;
    private $categoryMosqueId;
    private $juryId;
    private $juryName;
    private $search;

    private $index = 0;

    private $title = 'LAPORAN PENILAIAN AWAL AMALIAH ASTRA AWARDS 2024';
    private $fileName = 'Laporan-Penilaian-Awal-Peserta-Amaliah-Astra-Awards-2024.xlsx';

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

            $this->title = "LAPORAN PENILAIAN AWAL AMALIAH ASTRA AWARDS 2024\n" .
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
                    'mosque.presentation',
                    'mosque.presentation.startAssessment',
                    'mosque.pillarOne.committeeAssessmnet',
                    'mosque.pillarTwo.committeeAssessmnet',
                    'mosque.pillarThree.committeeAssessmnet',
                    'mosque.pillarFour.committeeAssessmnet',
                    'mosque.pillarFive.committeeAssessmnet'
                ])->whereHas('mosque', function ($q) use ($area, $mosque) {
                    $q->where('category_area_id', $area->id)->where('category_mosque_id', $mosque->id);
                })->where(function ($q) {
                    $q->whereHas('mosque.presentation');
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

                    if ($user->mosque->pillarOne && $user->mosque->pillarOne->committeeAssessmnet) {
                        $pillarOneTotal = 0;
                        $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_one;
                        $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_two;
                        $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_three;
                        $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_four;
                        $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_five;
                        $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_six;
                        $pillarOneTotal += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_seven;

                        $totalValue += $pillarOneTotal * $weightPillarOne;
                    }

                    if ($user->mosque->pillarTwo && $user->mosque->pillarTwo->committeeAssessmnet) {
                        $pillarTwoTotal = 0;
                        $pillarTwoTotal += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_two;
                        $pillarTwoTotal += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_three;
                        $pillarTwoTotal += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_four;
                        $pillarTwoTotal += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_five;

                        $totalValue += $pillarTwoTotal * $weightPillarTwo;
                    }

                    if ($user->mosque->pillarThree && $user->mosque->pillarThree->committeeAssessmnet) {
                        $pillarThreeTotal = 0;
                        $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_one;
                        $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_two;
                        $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_three;
                        $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_four;
                        $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_five;
                        $pillarThreeTotal += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_six;

                        $totalValue += $pillarThreeTotal * $weightPillarThree;
                    }

                    if ($user->mosque->pillarFour && $user->mosque->pillarFour->committeeAssessmnet) {
                        $pillarFourTotal = 0;
                        $pillarFourTotal += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_one;
                        $pillarFourTotal += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_two;
                        $pillarFourTotal += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_three;
                        $pillarFourTotal += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_four;
                        $pillarFourTotal += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_five;

                        $totalValue += $pillarFourTotal * $weightPillarFour;
                    }

                    if ($user->mosque->pillarFive && $user->mosque->pillarFive->committeeAssessmnet) {
                        $pillarFiveTotal = 0;
                        $pillarFiveTotal += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_one;
                        $pillarFiveTotal += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_two;
                        $pillarFiveTotal += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_three;
                        $pillarFiveTotal += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_four;
                        $pillarFiveTotal += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_five;

                        $totalValue += $pillarFiveTotal * $weightPillarFive;
                    }

                    $user->totalNilai = $totalValue;

                    return $user;
                })->filter(function ($user) {
                    return $user->totalNilai > 0;
                });

                $topUsers = $users->sortByDesc('totalNilai')->take(5);
                $allUsers = $allUsers->merge($topUsers);
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

            if ($user->mosque->presentation->startAssessmentForJury($this->juryId)->exists()) {
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
            $assessment = $user->mosque->presentation
                ->startAssessmentForJury($this->juryId)
                ->first();

            if ($assessment) {
                $pillarTwoValue += $assessment->presentation_file_pillar_two;
                $pillarOneValue += $assessment->presentation_file_pillar_one;
                $pillarThreeValue += $assessment->presentation_file_pillar_three;
                $pillarFourValue += $assessment->presentation_file_pillar_four;
                $pillarFiveValue += $assessment->presentation_file_pillar_five;

                // Total Nilai
                $totalValue  += $assessment->presentation_file_pillar_two +
                    $assessment->presentation_file_pillar_one +
                    $assessment->presentation_file_pillar_three +
                    $assessment->presentation_file_pillar_four +
                    $assessment->presentation_file_pillar_five;

                // Rekap Nilai
                $recapValue += $assessment->presentation_file_pillar_two * 0.25 +
                    $assessment->presentation_file_pillar_one * 0.25 +
                    $assessment->presentation_file_pillar_three * 0.2 +
                    $assessment->presentation_file_pillar_four * 0.15 +
                    $assessment->presentation_file_pillar_five * 0.15;
            }
        } else {
            // Status
            $status = 'Semua Juri Sudah Menilai';
            $totalJuries = User::where('role', 'jury')->count();

            $completedAssessments = $user->mosque->presentation
                ->startAssessment()
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

            $user->mosque->presentation->startAssessment->sum(function ($sumAssessment) use (&$pillarTwoValue) {
                $pillarTwoValue += $sumAssessment->presentation_file_pillar_two;
            });

            $user->mosque->presentation->startAssessment->sum(function ($sumAssessment) use (&$pillarOneValue) {
                $pillarOneValue += $sumAssessment->presentation_file_pillar_one;
            });

            $user->mosque->presentation->startAssessment->sum(function ($sumAssessment) use (&$pillarThreeValue) {
                $pillarThreeValue += $sumAssessment->presentation_file_pillar_three;
            });

            $user->mosque->presentation->startAssessment->sum(function ($sumAssessment) use (&$pillarFourValue) {
                $pillarFourValue += $sumAssessment->presentation_file_pillar_four;
            });

            $user->mosque->presentation->startAssessment->sum(function ($sumAssessment) use (&$pillarFiveValue) {
                $pillarFiveValue += $sumAssessment->presentation_file_pillar_five;
            });

            // Total Nilai
            $totalValue = null;
            $user->mosque->presentation->startAssessment->each(function ($sumAssessment) use (&$totalValue) {
                $totalValue += $sumAssessment->presentation_file_pillar_two +
                    $sumAssessment->presentation_file_pillar_one +
                    $sumAssessment->presentation_file_pillar_three +
                    $sumAssessment->presentation_file_pillar_four +
                    $sumAssessment->presentation_file_pillar_five;
            });

            // Rekap Nilai
            $recapValue = null;
            $user->mosque->presentation->startAssessment->each(function ($sumAssessment) use (&$recapValue) {
                $recapValue += $sumAssessment->presentation_file_pillar_two * 0.25 +
                    $sumAssessment->presentation_file_pillar_one * 0.25 +
                    $sumAssessment->presentation_file_pillar_three * 0.20 +
                    $sumAssessment->presentation_file_pillar_four * 0.15 +
                    $sumAssessment->presentation_file_pillar_five * 0.15;
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
        return 'Laporan Penilaian Awal';
    }
}
