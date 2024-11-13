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
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EndAssessmentRecapExport implements FromCollection, Responsable, WithCustomStartCell, WithMapping, ShouldAutoSize, WithStyles, WithTitle
{
    use Exportable;

    private $categoryAreaId;
    private $categoryMosqueId;
    private $search;

    private $index = 0;
    private $juryNames = [];

    private $title = 'REKAPITULASI PENILAIAN AKHIR AMALIAH ASTRA AWARDS 2024';
    private $fileName = 'Rekap-Penilaian-Akhir-Peserta-Amaliah-Astra-Awards-2024.xlsx';

    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/xlsx',
    ];

    public function __construct($categoryAreaId = null, $categoryMosqueId = null, $search = null)
    {
        $this->categoryAreaId = $categoryAreaId;
        $this->categoryMosqueId = $categoryMosqueId;
        $this->search = $search;

        $this->juryNames = User::where('role', 'jury')->pluck('name')->toArray();

        if ($this->categoryAreaId && $this->categoryMosqueId) {
            $categoryArea = CategoryArea::find($this->categoryAreaId);
            $categoryMosque = CategoryMosque::find($this->categoryMosqueId);

            $this->title = "REKAPITULASI PENILAIAN AKHIR AMALIAH ASTRA AWARDS 2024\n" .
                "BERDASARKAN KATEGORI " . strtoupper($categoryArea->name) . " DAN " . strtoupper($categoryMosque->name);
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
                    'mosque.endAssessment',
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
                        $q->whereHas('mosque', function ($q2) {
                            $q2->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->search) . '%']);
                        })->orWhereHas('mosque.company', function ($q3) {
                            $q3->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->search) . '%']);
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

                    if ($user->mosque->endAssessment->isNotEmpty()) {
                        $totalPillarOne = $user->mosque->endAssessment->sum('presentation_value_pillar_one');
                        $totalPillarTwo = $user->mosque->endAssessment->sum('presentation_value_pillar_two');
                        $totalPillarThree = $user->mosque->endAssessment->sum('presentation_value_pillar_three');
                        $totalPillarFour = $user->mosque->endAssessment->sum('presentation_value_pillar_four');
                        $totalPillarFive = $user->mosque->endAssessment->sum('presentation_value_pillar_five');

                        $totalValue += $totalPillarOne * $weightPillarOne;
                        $totalValue += $totalPillarTwo * $weightPillarTwo;
                        $totalValue += $totalPillarThree * $weightPillarThree;
                        $totalValue += $totalPillarFour * $weightPillarFour;
                        $totalValue += $totalPillarFive * $weightPillarFive;

                        $juryCount = $user->mosque->endAssessment->count();

                        if ($juryCount > 0) {
                            $totalValue = $totalValue / $juryCount;
                        }
                    }

                    $user->totalNilai = $totalValue;

                    return $user;
                })->filter(function ($user) {
                    return $user->totalNilai > 0;
                });

                $topUsers = $users->sortByDesc('totalNilai')->take(3);
                $allUsers = $allUsers->merge($topUsers);
            }
        }

        return $allUsers;
    }

    public function startCell(): string
    {
        return 'B4';
    }

    public function map($user): array
    {
        $this->index++;

        $totalScore = 0;
        $jurorScores = [];

        $assessments = $user->mosque->endAssessment;

        if ($assessments->count() > 0) {
            foreach ($assessments as $assessment) {
                $score = 0;
                $score += $assessment->presentation_value_pillar_two * 0.25;
                $score += $assessment->presentation_value_pillar_one * 0.25;
                $score += $assessment->presentation_value_pillar_three * 0.2;
                $score += $assessment->presentation_value_pillar_four * 0.15;
                $score += $assessment->presentation_value_pillar_five * 0.15;

                $jurorName = $assessment->jury->name;
                $jurorScores[$jurorName] = number_format($score, 2, ',', '');
                $totalScore += $score;
            }
        }

        $formattedTotalScore = number_format($totalScore, 2, ',', '');

        $jurorCount = count($jurorScores);
        $averageScore = $jurorCount > 0 ? $totalScore / $jurorCount : 0;
        $formattedAverageScore = number_format($averageScore, 2, ',', '');

        $data = [
            $this->index,
            $user->mosque->name,
            $user->mosque->company->name,
            $user->mosque->city->province->name,
            $user->mosque->categoryMosque->name,
            $user->mosque->categoryArea->name,
        ];

        foreach ($this->juryNames as $juryName) {
            $data[] = isset($jurorScores[$juryName]) ? $jurorScores[$juryName] : '0,00';
        }

        $data[] = $formattedTotalScore;
        $data[] = $formattedAverageScore;

        return $data;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells("B2:B3");
        $sheet->mergeCells("C2:C3");
        $sheet->mergeCells("D2:D3");
        $sheet->mergeCells("E2:E3");
        $sheet->mergeCells("F2:F3");
        $sheet->mergeCells("G2:G3");

        $sheet->setCellValue("B2", 'NO');
        $sheet->setCellValue("C2", 'NAMA MASJID/MUSALA');
        $sheet->setCellValue("D2", 'PERUSAHAAN');
        $sheet->setCellValue("E2", 'PROVINSI');
        $sheet->setCellValue("F2", 'KATEGORI');
        $sheet->setCellValue("G2", 'KATEGORI AREA');

        $sheet->getColumnDimension("B")->setAutoSize(true);
        $sheet->getColumnDimension("C")->setAutoSize(true);
        $sheet->getColumnDimension("D")->setAutoSize(true);
        $sheet->getColumnDimension("E")->setAutoSize(true);
        $sheet->getColumnDimension("F")->setAutoSize(true);
        $sheet->getColumnDimension("G")->setAutoSize(true);

        $startingColumnIndex = ord('H');
        $totalJurors = count($this->juryNames);
        $lastJurorColumn = chr($startingColumnIndex + $totalJurors - 1);

        $sheet->mergeCells("H2:{$lastJurorColumn}2");
        $sheet->setCellValue("H2", 'NILAI JURI');

        foreach ($this->juryNames as $index => $item) {
            $column = chr($startingColumnIndex + $index);
            $sheet->setCellValue("{$column}3", $item);
            $sheet->getColumnDimension($column)->setAutoSize(true);
            $sheet->getStyle("{$column}3")->applyFromArray([
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF004EA2'],
                ],
            ]);
        }

        $nextColumnIndex = $startingColumnIndex + $totalJurors;
        $totalColumn = chr($nextColumnIndex);
        $averageColumn = chr($nextColumnIndex + 1);

        $sheet->setCellValue("{$totalColumn}2", 'TOTAL');
        $sheet->setCellValue("{$averageColumn}2", 'RATA RATA');

        $sheet->mergeCells("{$totalColumn}2:{$totalColumn}3");
        $sheet->mergeCells("{$averageColumn}2:{$averageColumn}3");

        $sheet->getColumnDimension("{$totalColumn}")->setAutoSize(true);
        $sheet->getColumnDimension("{$averageColumn}")->setAutoSize(true);

        $dynamicStyles = [
            "B2:{$averageColumn}2" => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF004EA2'],
                ],
            ],
            "H:{$averageColumn}" => [
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
            ],
            "{$averageColumn}" => [
                'font' => ['bold' => true],
            ],
        ];

        $sheet->mergeCells("B1:{$averageColumn}1");
        $sheet->setCellValue('B1', "\n\n" . $this->title);
        $sheet->getRowDimension(1)->setRowHeight(100);

        $sheet->getStyle("B1:{$averageColumn}1")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("B1:{$averageColumn}1")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM);

        $styles = array_merge($dynamicStyles, [
            "B1:{$averageColumn}1" => [
                'font' => ['bold' => true, 'size' => 16, 'color' => ['argb' => 'FF000000']],
                'alignment' => ['wrapText' => true],
            ],
            'B' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'C' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'D' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'E' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'F' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
            'G' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
        ]);

        $lastDataRow = $sheet->getHighestRow();
        for ($rowIndex = 2; $rowIndex <= $lastDataRow; $rowIndex++) {
            $sheet->getRowDimension($rowIndex)->setRowHeight(30);
            $sheet->getStyle('B' . $rowIndex . ':' . $averageColumn . $rowIndex)->getAlignment()->setIndent(1);
        }

        for ($rowIndex = 3; $rowIndex <= $lastDataRow; $rowIndex++) {
            $sheet->getRowDimension($rowIndex)->setRowHeight(30);
            $sheet->getStyle('B' . $rowIndex . ':' . $averageColumn . $rowIndex)->getAlignment()->setIndent(1);
        }

        for ($rowIndex = 4; $rowIndex <= $lastDataRow; $rowIndex++) {
            $sheet->getRowDimension($rowIndex)->setRowHeight(20);
            $sheet->getStyle('C' . $rowIndex . ':' . $averageColumn . $rowIndex)->getAlignment()->setIndent(1);
        }

        $sheet->getStyle("B2:{$averageColumn}{$lastDataRow}")
        ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        foreach ($styles as $range => $style) {
            $sheet->getStyle($range)->applyFromArray($style);
        }

        return $styles;
    }

    public function title(): string
    {
        return 'Rekap Penilaian Akhir';
    }
}
