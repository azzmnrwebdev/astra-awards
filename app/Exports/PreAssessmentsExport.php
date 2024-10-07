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
    private $search;

    private $index = 0;

    private $title = 'LAPORAN PRA PENILAIAN PESERTA SEMUA KATEGORI';
    private $fileName = 'Daftar-Pra-Penilaian-Peserta-Amaliah-Astra-Awards-2024.xlsx';

    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/xlsx',
    ];

    public function __construct($categoryAreaId = null, $categoryMosqueId = null, $search = null)
    {
        $this->categoryAreaId = $categoryAreaId;
        $this->categoryMosqueId = $categoryMosqueId;
        $this->search = $search;

        if ($this->categoryAreaId && $this->categoryMosqueId) {
            $categoryArea = CategoryArea::find($this->categoryAreaId);
            $categoryMosque = CategoryMosque::find($this->categoryMosqueId);

            $this->title = 'LAPORAN PRA PENILAIAN PESERTA KATEGORI ' . strtoupper($categoryArea->name) . ' DAN ' . strtoupper($categoryMosque->name);
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
                        COALESCE(
                            (SELECT SUM(pillar_one_question_one + pillar_one_question_two + pillar_one_question_three + pillar_one_question_four + pillar_one_question_five + pillar_one_question_six + pillar_one_question_seven)
                            FROM committee_assessments WHERE committee_assessments.pillar_one_id = pillar_ones.id), 0)
                        +
                        COALESCE(
                            (SELECT SUM(pillar_two_question_two + pillar_two_question_three + pillar_two_question_four + pillar_two_question_five)
                            FROM committee_assessments WHERE committee_assessments.pillar_two_id = pillar_twos.id), 0)
                        +
                        COALESCE(
                            (SELECT SUM(pillar_three_question_one + pillar_three_question_two + pillar_three_question_three + pillar_three_question_four + pillar_three_question_five + pillar_three_question_six)
                            FROM committee_assessments WHERE committee_assessments.pillar_three_id = pillar_threes.id), 0)
                        +
                        COALESCE(
                            (SELECT SUM(pillar_four_question_one + pillar_four_question_two + pillar_four_question_three + pillar_four_question_four + pillar_four_question_five)
                            FROM committee_assessments WHERE committee_assessments.pillar_four_id = pillar_fours.id), 0)
                        +
                        COALESCE(
                            (SELECT SUM(pillar_five_question_one + pillar_five_question_two + pillar_five_question_three + pillar_five_question_four + pillar_five_question_five)
                            FROM committee_assessments WHERE committee_assessments.pillar_five_id = pillar_fives.id), 0)
                    ) AS totalPillarValue
                ')
                ->orderBy('totalPillarValue', 'desc')
                ->get();
        } else {
            return $query->orderByDesc('users.updated_at')->latest('users.created_at')->get();
        }
    }

    public function startCell(): string
    {
        return 'B2';
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

        if ($pillarOne && $pillarOne->committeeAssessmnet?->pillar_one_id) {
            $pillarOneAssessment = $pillarOne->committeeAssessmnet;
            if (
                $pillarOneAssessment->pillar_one_question_one ||
                $pillarOneAssessment->pillar_one_question_two ||
                $pillarOneAssessment->pillar_one_question_three ||
                $pillarOneAssessment->pillar_one_question_four ||
                $pillarOneAssessment->pillar_one_question_five ||
                $pillarOneAssessment->pillar_one_question_six ||
                $pillarOneAssessment->pillar_one_question_seven
            ) {
                $filledPillars++;
            }
        }

        if ($pillarTwo && $pillarTwo->committeeAssessmnet?->pillar_two_id) {
            $pillarTwoAssessment = $pillarTwo->committeeAssessmnet;
            if (
                $pillarTwoAssessment->pillar_two_question_two ||
                $pillarTwoAssessment->pillar_two_question_three ||
                $pillarTwoAssessment->pillar_two_question_four ||
                $pillarTwoAssessment->pillar_two_question_five
            ) {
                $filledPillars++;
            }
        }

        if ($pillarThree && $pillarThree->committeeAssessmnet?->pillar_three_id) {
            $pillarThreeAssessment = $pillarThree->committeeAssessmnet;
            if (
                $pillarThreeAssessment->pillar_three_question_one ||
                $pillarThreeAssessment->pillar_three_question_two ||
                $pillarThreeAssessment->pillar_three_question_three ||
                $pillarThreeAssessment->pillar_three_question_four ||
                $pillarThreeAssessment->pillar_three_question_five ||
                $pillarThreeAssessment->pillar_three_question_six
            ) {
                $filledPillars++;
            }
        }

        if ($pillarFour && $pillarFour->committeeAssessmnet?->pillar_four_id) {
            $pillarFourAssessment = $pillarFour->committeeAssessmnet;
            if (
                $pillarFourAssessment->pillar_four_question_one ||
                $pillarFourAssessment->pillar_four_question_two ||
                $pillarFourAssessment->pillar_four_question_three ||
                $pillarFourAssessment->pillar_four_question_four ||
                $pillarFourAssessment->pillar_four_question_five
            ) {
                $filledPillars++;
            }
        }

        if ($pillarFive && $pillarFive->committeeAssessmnet?->pillar_five_id) {
            $pillarFiveAssessment = $pillarFive->committeeAssessmnet;
            if (
                $pillarFiveAssessment->pillar_five_question_one ||
                $pillarFiveAssessment->pillar_five_question_two ||
                $pillarFiveAssessment->pillar_five_question_three ||
                $pillarFiveAssessment->pillar_five_question_four ||
                $pillarFiveAssessment->pillar_five_question_five
            ) {
                $filledPillars++;
            }
        }

        if ($filledPillars > 0 && $filledPillars < 5) {
            $status = 'Sebagian Formulir';
        } elseif ($filledPillars == 5) {
            $status = 'Semua Formulir';
        }

        return [
            $this->index,
            $user->name,
            $user->mosque->company->name,
            $user->mosque->name,
            $status,
            $user->mosque->total_pillar_value !== 0 ? $user->mosque->total_pillar_value : 'Belum Tersedia',
        ];
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA LENGKAP',
            'PERUSAHAAN',
            'NAMA MASJID/MUSALA',
            'STATUS',
            'TOTAL NILAI',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('B1:G1');
        $sheet->setCellValue('B1', $this->title);
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
            'D' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'E' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'F' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'G' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
        ];
    }

    public function title(): string
    {
        return 'Pra Penilaian';
    }
}
