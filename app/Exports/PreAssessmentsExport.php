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

class PreAssessmentsExport implements FromCollection, Responsable, WithCustomStartCell, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithTitle
{
    use Exportable;

    private $categoryAreaId;
    private $categoryMosqueId;
    private $committeId;
    private $committeName;
    private $search;

    private $index = 0;

    private $title;
    private $fileName;

    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/xlsx',
    ];

    public function __construct($categoryAreaId = null, $categoryMosqueId = null, $committeId = null, $search = null)
    {
        $currentYear = date('Y');

        $this->categoryAreaId = $categoryAreaId;
        $this->categoryMosqueId = $categoryMosqueId;
        $this->committeId = $committeId;
        $this->search = $search;

        $this->title = "LAPORAN PRA PENILAIAN AMALIAH ASTRA AWARDS $currentYear";
        $this->fileName = "Laporan-Pra-Penilaian-Peserta-Amaliah-Astra-Awards-$currentYear.xlsx";

        if ($this->categoryAreaId && $this->categoryMosqueId) {
            $categoryArea = CategoryArea::find($this->categoryAreaId);
            $categoryMosque = CategoryMosque::find($this->categoryMosqueId);

            $this->title = "LAPORAN PRA PENILAIAN AMALIAH ASTRA AWARDS $currentYear\n" .
                "BERDASARKAN KATEGORI " . strtoupper($categoryArea->name) . " DAN " . strtoupper($categoryMosque->name);
        }

        if ($this->committeId) {
            $committeName = User::find($this->committeId);
            $this->committeName = strtoupper($committeName->name);
        }
    }

    public function collection()
    {
        $query = User::with([
            'mosque',
            'mosque.pillarOne',
            'mosque.pillarTwo',
            'mosque.pillarThree',
            'mosque.pillarFour',
            'mosque.pillarFive'
        ])->where('role', 'user');

        if ($this->categoryAreaId && $this->categoryMosqueId) {
            $query->whereHas('mosque', function ($q) {
                $q->where('category_area_id', $this->categoryAreaId)
                    ->where('category_mosque_id', $this->categoryMosqueId);
            });
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->whereRaw('LOWER(users.name) LIKE ?', ['%' . strtolower($this->search) . '%'])
                    ->orWhereHas('mosque', function ($q1) {
                        $q1->whereRaw('LOWER(mosques.name) LIKE ?', ['%' . strtolower($this->search) . '%']);
                    })
                    ->orWhereHas('mosque.company', function ($q2) {
                        $q2->whereRaw('LOWER(companies.name) LIKE ?', ['%' . strtolower($this->search) . '%']);
                    });
            });
        }

        if ($this->committeId) {
            $query->whereHas('distributions', function ($q) {
                $q->where('committe_id', $this->committeId);
            });
        }

        $query->where(function ($q) {
            $q->whereHas('mosque.pillarOne')
                ->orWhereHas('mosque.pillarTwo')
                ->orWhereHas('mosque.pillarThree')
                ->orWhereHas('mosque.pillarFour')
                ->orWhereHas('mosque.pillarFive');
        });

        if ($this->categoryAreaId && $this->categoryMosqueId) {
            return $query->select('users.*')
                ->leftJoin('mosques', 'mosques.user_id', '=', 'users.id')
                ->leftJoin('pillar_ones', 'pillar_ones.mosque_id', '=', 'mosques.id')
                ->leftJoin('pillar_twos', 'pillar_twos.mosque_id', '=', 'mosques.id')
                ->leftJoin('pillar_threes', 'pillar_threes.mosque_id', '=', 'mosques.id')
                ->leftJoin('pillar_fours', 'pillar_fours.mosque_id', '=', 'mosques.id')
                ->leftJoin('pillar_fives', 'pillar_fives.mosque_id', '=', 'mosques.id')
                ->selectRaw('
                    (
                        COALESCE((
                            SELECT SUM(
                                COALESCE(pillar_one_question_one, 0) +
                                COALESCE(pillar_one_question_two, 0) +
                                COALESCE(pillar_one_question_three, 0) +
                                COALESCE(pillar_one_question_four, 0) +
                                COALESCE(pillar_one_question_five, 0) +
                                COALESCE(pillar_one_question_six, 0) +
                                COALESCE(pillar_one_question_seven, 0)
                            ) * 0.25
                            FROM committee_assessments
                            WHERE committee_assessments.pillar_one_id = pillar_ones.id
                        ), 0) +
                        COALESCE((
                            SELECT SUM(
                                COALESCE(pillar_two_question_two, 0) +
                                COALESCE(pillar_two_question_three, 0) +
                                COALESCE(pillar_two_question_four, 0) +
                                COALESCE(pillar_two_question_five, 0)
                            ) * 0.25
                            FROM committee_assessments
                            WHERE committee_assessments.pillar_two_id = pillar_twos.id
                        ), 0) +
                        COALESCE((
                            SELECT SUM(
                                COALESCE(pillar_three_question_one, 0) +
                                COALESCE(pillar_three_question_two, 0) +
                                COALESCE(pillar_three_question_three, 0) +
                                COALESCE(pillar_three_question_four, 0) +
                                COALESCE(pillar_three_question_five, 0) +
                                COALESCE(pillar_three_question_six, 0)
                            ) * 0.20
                            FROM committee_assessments
                            WHERE committee_assessments.pillar_three_id = pillar_threes.id
                        ), 0) +
                        COALESCE((
                            SELECT SUM(
                                COALESCE(pillar_four_question_one, 0) +
                                COALESCE(pillar_four_question_two, 0) +
                                COALESCE(pillar_four_question_three, 0) +
                                COALESCE(pillar_four_question_four, 0) +
                                COALESCE(pillar_four_question_five, 0)
                            ) * 0.15
                            FROM committee_assessments
                            WHERE committee_assessments.pillar_four_id = pillar_fours.id
                        ), 0) +
                        COALESCE((
                            SELECT SUM(
                                COALESCE(pillar_five_question_one, 0) +
                                COALESCE(pillar_five_question_two, 0) +
                                COALESCE(pillar_five_question_three, 0) +
                                COALESCE(pillar_five_question_four, 0) +
                                COALESCE(pillar_five_question_five, 0)
                            ) * 0.15
                            FROM committee_assessments
                            WHERE committee_assessments.pillar_five_id = pillar_fives.id
                        ), 0)
                    ) AS "totalPillarValue"
                ')
                ->orderByDesc('totalPillarValue')
                ->get();
        } else {
            return $query->select('users.*')
                ->leftJoin('mosques', 'mosques.user_id', '=', 'users.id')
                ->leftJoin('pillar_ones', 'pillar_ones.mosque_id', '=', 'mosques.id')
                ->leftJoin('pillar_twos', 'pillar_twos.mosque_id', '=', 'mosques.id')
                ->leftJoin('pillar_threes', 'pillar_threes.mosque_id', '=', 'mosques.id')
                ->leftJoin('pillar_fours', 'pillar_fours.mosque_id', '=', 'mosques.id')
                ->leftJoin('pillar_fives', 'pillar_fives.mosque_id', '=', 'mosques.id')
                ->selectRaw('
                    (
                        COALESCE((
                            SELECT SUM(
                                COALESCE(pillar_one_question_one, 0) +
                                COALESCE(pillar_one_question_two, 0) +
                                COALESCE(pillar_one_question_three, 0) +
                                COALESCE(pillar_one_question_four, 0) +
                                COALESCE(pillar_one_question_five, 0) +
                                COALESCE(pillar_one_question_six, 0) +
                                COALESCE(pillar_one_question_seven, 0)
                            ) * 0.25
                            FROM committee_assessments
                            WHERE committee_assessments.pillar_one_id = pillar_ones.id
                        ), 0) +
                        COALESCE((
                            SELECT SUM(
                                COALESCE(pillar_two_question_two, 0) +
                                COALESCE(pillar_two_question_three, 0) +
                                COALESCE(pillar_two_question_four, 0) +
                                COALESCE(pillar_two_question_five, 0)
                            ) * 0.25
                            FROM committee_assessments
                            WHERE committee_assessments.pillar_two_id = pillar_twos.id
                        ), 0) +
                        COALESCE((
                            SELECT SUM(
                                COALESCE(pillar_three_question_one, 0) +
                                COALESCE(pillar_three_question_two, 0) +
                                COALESCE(pillar_three_question_three, 0) +
                                COALESCE(pillar_three_question_four, 0) +
                                COALESCE(pillar_three_question_five, 0) +
                                COALESCE(pillar_three_question_six, 0)
                            ) * 0.20
                            FROM committee_assessments
                            WHERE committee_assessments.pillar_three_id = pillar_threes.id
                        ), 0) +
                        COALESCE((
                            SELECT SUM(
                                COALESCE(pillar_four_question_one, 0) +
                                COALESCE(pillar_four_question_two, 0) +
                                COALESCE(pillar_four_question_three, 0) +
                                COALESCE(pillar_four_question_four, 0) +
                                COALESCE(pillar_four_question_five, 0)
                            ) * 0.15
                            FROM committee_assessments
                            WHERE committee_assessments.pillar_four_id = pillar_fours.id
                        ), 0) +
                        COALESCE((
                            SELECT SUM(
                                COALESCE(pillar_five_question_one, 0) +
                                COALESCE(pillar_five_question_two, 0) +
                                COALESCE(pillar_five_question_three, 0) +
                                COALESCE(pillar_five_question_four, 0) +
                                COALESCE(pillar_five_question_five, 0)
                            ) * 0.15
                            FROM committee_assessments
                            WHERE committee_assessments.pillar_five_id = pillar_fives.id
                        ), 0)
                    ) AS "totalPillarValue"
                ')
                ->orderByDesc('totalPillarValue')
                ->get();
        }
    }

    public function startCell(): string
    {
        if ($this->committeId) {
            return 'B3';
        } else {
            return 'B2';
        }
    }

    public function map($user): array
    {
        $this->index++;

        $filledPillars = 0;
        $status = 'Belum Penilaian';

        $pillarOne = $user->mosque->pillarOne;
        $pillarTwo = $user->mosque->pillarTwo;
        $pillarThree = $user->mosque->pillarThree;
        $pillarFour = $user->mosque->pillarFour;
        $pillarFive = $user->mosque->pillarFive;

        $pillarOneTotal = $pillarTwoTotal = $pillarThreeTotal = $pillarFourTotal = $pillarFiveTotal = "Belum Tersedia";
        $pillarOneTotalValue = $pillarTwoTotalValue = $pillarThreeTotalValue = $pillarFourTotalValue = $pillarFiveTotalValue = 0;

        if ($pillarOne && $pillarOne->committeeAssessmnet?->pillar_one_id) {
            $pillarOneAssessment = $pillarOne->committeeAssessmnet;

            $pillarOneTotalValue =
                $pillarOneAssessment->pillar_one_question_one +
                $pillarOneAssessment->pillar_one_question_two +
                $pillarOneAssessment->pillar_one_question_three +
                $pillarOneAssessment->pillar_one_question_four +
                $pillarOneAssessment->pillar_one_question_five +
                $pillarOneAssessment->pillar_one_question_six +
                $pillarOneAssessment->pillar_one_question_seven;

            $pillarOneTotal = $pillarOneTotalValue > 0 ? $pillarOneTotalValue : 'Belum Tersedia';

            if (
                $pillarOneAssessment->pillar_one_question_one &&
                $pillarOneAssessment->pillar_one_question_two &&
                $pillarOneAssessment->pillar_one_question_three &&
                $pillarOneAssessment->pillar_one_question_four &&
                $pillarOneAssessment->pillar_one_question_five &&
                $pillarOneAssessment->pillar_one_question_six &&
                $pillarOneAssessment->pillar_one_question_seven
            ) {
                $filledPillars++;
            }
        }

        if ($pillarTwo && $pillarTwo->committeeAssessmnet?->pillar_two_id) {
            $pillarTwoAssessment = $pillarTwo->committeeAssessmnet;

            $pillarTwoTotalValue =
                $pillarTwoAssessment->pillar_two_question_two +
                $pillarTwoAssessment->pillar_two_question_three +
                $pillarTwoAssessment->pillar_two_question_four +
                $pillarTwoAssessment->pillar_two_question_five;

            $pillarTwoTotal = $pillarTwoTotalValue > 0 ? $pillarTwoTotalValue : 'Belum Tersedia';

            if (
                $pillarTwoAssessment->pillar_two_question_two &&
                $pillarTwoAssessment->pillar_two_question_three &&
                $pillarTwoAssessment->pillar_two_question_four &&
                $pillarTwoAssessment->pillar_two_question_five
            ) {
                $filledPillars++;
            }
        }

        if ($pillarThree && $pillarThree->committeeAssessmnet?->pillar_three_id) {
            $pillarThreeAssessment = $pillarThree->committeeAssessmnet;

            $pillarThreeTotalValue =
                $pillarThreeAssessment->pillar_three_question_one +
                $pillarThreeAssessment->pillar_three_question_two +
                $pillarThreeAssessment->pillar_three_question_three +
                $pillarThreeAssessment->pillar_three_question_four +
                $pillarThreeAssessment->pillar_three_question_five +
                $pillarThreeAssessment->pillar_three_question_six;

            $pillarThreeTotal = $pillarThreeTotalValue > 0 ? $pillarThreeTotalValue : 'Belum Tersedia';

            if (
                $pillarThreeAssessment->pillar_three_question_one &&
                $pillarThreeAssessment->pillar_three_question_two &&
                $pillarThreeAssessment->pillar_three_question_three &&
                $pillarThreeAssessment->pillar_three_question_four &&
                $pillarThreeAssessment->pillar_three_question_five &&
                $pillarThreeAssessment->pillar_three_question_six
            ) {
                $filledPillars++;
            }
        }

        if ($pillarFour && $pillarFour->committeeAssessmnet?->pillar_four_id) {
            $pillarFourAssessment = $pillarFour->committeeAssessmnet;

            $pillarFourTotalValue =
                $pillarFourAssessment->pillar_four_question_one +
                $pillarFourAssessment->pillar_four_question_two +
                $pillarFourAssessment->pillar_four_question_three +
                $pillarFourAssessment->pillar_four_question_four +
                $pillarFourAssessment->pillar_four_question_five;

            $pillarFourTotal = $pillarFourTotalValue > 0 ? $pillarFourTotalValue : 'Belum Tersedia';

            if (
                $pillarFourAssessment->pillar_four_question_one &&
                $pillarFourAssessment->pillar_four_question_two &&
                $pillarFourAssessment->pillar_four_question_three &&
                $pillarFourAssessment->pillar_four_question_four &&
                $pillarFourAssessment->pillar_four_question_five
            ) {
                $filledPillars++;
            }
        }

        if ($pillarFive && $pillarFive->committeeAssessmnet?->pillar_five_id) {
            $pillarFiveAssessment = $pillarFive->committeeAssessmnet;

            $pillarFiveTotalValue =
                $pillarFiveAssessment->pillar_five_question_one +
                $pillarFiveAssessment->pillar_five_question_two +
                $pillarFiveAssessment->pillar_five_question_three +
                $pillarFiveAssessment->pillar_five_question_four +
                $pillarFiveAssessment->pillar_five_question_five;

            $pillarFiveTotal = $pillarFiveTotalValue > 0 ? $pillarFiveTotalValue : 'Belum Tersedia';

            if (
                $pillarFiveAssessment->pillar_five_question_one &&
                $pillarFiveAssessment->pillar_five_question_two &&
                $pillarFiveAssessment->pillar_five_question_three &&
                $pillarFiveAssessment->pillar_five_question_four &&
                $pillarFiveAssessment->pillar_five_question_five
            ) {
                $filledPillars++;
            }
        }

        if ($filledPillars === 5) {
            $status = 'Semua Formulir';
        } elseif ($filledPillars > 0 && $filledPillars < 5) {
            $status = 'Sebagian Formulir';
        }

        return [
            $this->index,
            $user->mosque->name,
            $user->mosque->company->name,
            $user->mosque->city->province->name,
            $user->mosque->categoryMosque->name,
            $user->mosque->categoryArea->name,
            $status,
            $pillarTwoTotal,
            $pillarOneTotal,
            $pillarThreeTotal,
            $pillarFourTotal,
            $pillarFiveTotal,
            $user->mosque->total_pillar_value !== 0 ? $user->mosque->total_pillar_value : 'Belum Tersedia',
            $user->totalPillarValue != 0 ? str_replace('.', ',', $user->totalPillarValue) : "Belum Tersedia"
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

        if ($this->committeId) {
            $sheet->mergeCells('B2:O2');
            $sheet->setCellValue('B2', 'NAMA PANITIA                      :  ' . $this->committeName);
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
                'I' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'J' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'K' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'L' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'M' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
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
                'I' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'J' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'K' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'L' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'M' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
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
                'N' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'O' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            ];
        }
    }

    public function title(): string
    {
        return 'Pra Penilaian';
    }
}
