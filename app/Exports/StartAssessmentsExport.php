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
    private $fileName = 'Daftar-Penilaian-Awal-Peserta-Amaliah-Astra-Awards-2024.xlsx';

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
                })->when($this->juryId, function ($query) {
                    $query->where(function ($q) {
                        $q->whereHas('mosque.presentation.startAssessment', function ($q2) {
                            $q2->where('jury_id', $this->juryId);
                        });
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

                    if ($user->mosque->presentation && $user->mosque->presentation->startAssessment) {
                        $totalValue += $user->mosque->presentation->startAssessment->presentation_file;
                    }

                    if ($user->mosque->pillarOne && $user->mosque->pillarOne->committeeAssessmnet) {
                        $totalValue += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_one;
                        $totalValue += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_two;
                        $totalValue += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_three;
                        $totalValue += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_four;
                        $totalValue += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_five;
                        $totalValue += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_six;
                        $totalValue += $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_seven;
                    }

                    if ($user->mosque->pillarTwo && $user->mosque->pillarTwo->committeeAssessmnet) {
                        $totalValue += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_two;
                        $totalValue += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_three;
                        $totalValue += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_four;
                        $totalValue += $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_five;
                    }

                    if ($user->mosque->pillarThree && $user->mosque->pillarThree->committeeAssessmnet) {
                        $totalValue += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_one;
                        $totalValue += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_two;
                        $totalValue += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_three;
                        $totalValue += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_four;
                        $totalValue += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_five;
                        $totalValue += $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_six;
                    }

                    if ($user->mosque->pillarFour && $user->mosque->pillarFour->committeeAssessmnet) {
                        $totalValue += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_one;
                        $totalValue += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_two;
                        $totalValue += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_three;
                        $totalValue += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_four;
                        $totalValue += $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_five;
                    }

                    if ($user->mosque->pillarFive && $user->mosque->pillarFive->committeeAssessmnet) {
                        $totalValue += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_one;
                        $totalValue += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_two;
                        $totalValue += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_three;
                        $totalValue += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_four;
                        $totalValue += $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_five;
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

        $pillarOneValue = $user->mosque->pillarOne && $user->mosque->pillarOne->committeeAssessmnet ? (
            $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_one +
            $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_two +
            $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_three +
            $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_four +
            $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_five +
            $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_six +
            $user->mosque->pillarOne->committeeAssessmnet->pillar_one_question_seven
        ) : 'Belum Tersedia';

        $pillarTwoValue = $user->mosque->pillarTwo && $user->mosque->pillarTwo->committeeAssessmnet ? (
            $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_two +
            $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_three +
            $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_four +
            $user->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_five
        ) : 'Belum Tersedia';

        $pillarThreeValue = $user->mosque->pillarThree && $user->mosque->pillarThree->committeeAssessmnet ? (
            $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_one +
            $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_two +
            $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_three +
            $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_four +
            $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_five +
            $user->mosque->pillarThree->committeeAssessmnet->pillar_three_question_six
        ) : 'Belum Tersedia';

        $pillarFourValue = $user->mosque->pillarFour && $user->mosque->pillarFour->committeeAssessmnet ? (
            $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_one +
            $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_two +
            $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_three +
            $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_four +
            $user->mosque->pillarFour->committeeAssessmnet->pillar_four_question_five
        ) : 'Belum Tersedia';

        $pillarFiveValue = $user->mosque->pillarFive && $user->mosque->pillarFive->committeeAssessmnet ? (
            $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_one +
            $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_two +
            $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_three +
            $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_four +
            $user->mosque->pillarFive->committeeAssessmnet->pillar_five_question_five
        ) : 'Belum Tersedia';

        $filePresentationValue = $user->mosque->presentation && $user->mosque->presentation->startAssessment ?
            $user->mosque->presentation->startAssessment->presentation_file : 'Belum Tersedia';

        return [
            $this->index,
            $user->mosque->name,
            $user->mosque->company->name,
            $user->mosque->categoryMosque->name,
            $user->mosque->categoryArea->name,
            $user->mosque->presentation->startAssessment ? 'Sudah Penilaian' : 'Belum Penilaian',
            $pillarTwoValue,
            $pillarOneValue,
            $pillarThreeValue,
            $pillarFourValue,
            $pillarFiveValue,
            $filePresentationValue,
            $user->totalNilai,
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
            'STATUS',
            'HUBUNGAN DENGAN YAYASAN AMALIAH ASTRA',
            'HUBUNGAN MANAJEMEN PERUSAHAAN DENGAN DKM & JAMAAH',
            'PROGRAM SOSIAL',
            'ADMINISTRASI & KEUANGAN',
            'PERIBADAHAN & INFRASTRUKTUR',
            'FILE PRESENTASI',
            'TOTAL NILAI',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('B1:N1');
        $sheet->setCellValue('B1', "\n\n" . $this->title);
        $sheet->getRowDimension(1)->setRowHeight(100);

        $sheet->getStyle('B1:N1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B1:N1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_BOTTOM);

        if ($this->juryId) {
            $sheet->mergeCells('B2:N2');
            $sheet->setCellValue('B2', 'NAMA JURI                      :  ' . $this->juryName);
            $sheet->getRowDimension(2)->setRowHeight(20);

            $sheet->getRowDimension(3)->setRowHeight(30);
            $sheet->getStyle('C3:N3')->getAlignment()->setIndent(1);

            $lastDataRow = $sheet->getHighestRow();
            for ($rowIndex = 4; $rowIndex <= $lastDataRow; $rowIndex++) {
                $sheet->getRowDimension($rowIndex)->setRowHeight(20);
                $sheet->getStyle('C' . $rowIndex . ':N' . $rowIndex)->getAlignment()->setIndent(1);
            }

            $sheet->getStyle('B3:N' . $lastDataRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            return [
                'B1:N1' => [
                    'font' => ['bold' => true, 'size' => 16, 'color' => ['argb' => 'FF000000']],
                    'alignment' => ['wrapText' => true],
                ],
                'B' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'B2:N2' => [
                    'font' => ['bold' => true],
                    'alignment' => ['horizontal' => 'left', 'wrapText' => true],
                ],
                'H' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'I' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'J' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'K' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'L' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'M' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'N' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'B3:N3' => [
                    'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'], 'uppercase' => true],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                    'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF004EA2']],
                ],
                'C' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'D' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'E' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'F' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'G' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            ];
        } else {
            $sheet->getRowDimension(2)->setRowHeight(30);
            $sheet->getStyle('C2:N2')->getAlignment()->setIndent(1);

            $lastDataRow = $sheet->getHighestRow();
            for ($rowIndex = 3; $rowIndex <= $lastDataRow; $rowIndex++) {
                $sheet->getRowDimension($rowIndex)->setRowHeight(20);
                $sheet->getStyle('C' . $rowIndex . ':N' . $rowIndex)->getAlignment()->setIndent(1);
            }

            $sheet->getStyle('B2:N' . $lastDataRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            return [
                'B1:N1' => [
                    'font' => ['bold' => true, 'size' => 16, 'color' => ['argb' => 'FF000000']],
                    'alignment' => ['wrapText' => true],
                ],
                'H' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'I' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'J' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'K' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'L' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'M' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'N' => ['alignment' => ['horizontal' => 'right', 'vertical' => 'center', 'wrapText' => true]],
                'B2:N2' => [
                    'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'], 'uppercase' => true],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
                    'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF004EA2']],
                ],
                'B' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
                'C' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'D' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'E' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'F' => ['alignment' => ['vertical' => 'center', 'wrapText' => true]],
                'G' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            ];
        }
    }

    public function title(): string
    {
        return 'Penilaian Awal';
    }
}
