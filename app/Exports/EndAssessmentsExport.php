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
    private $search;

    private $index = 0;

    private $title = 'LAPORAN PENILAIAN AKHIR PESERTA SEMUA KATEGORI';
    private $fileName = 'Daftar-Penilaian-Akhir-Peserta-Amaliah-Astra-Awards-2024.xlsx';

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

            $this->title = 'LAPORAN PENILAIAN AKHIR PESERTA KATEGORI ' . strtoupper($categoryArea->name) . ' DAN ' . strtoupper($categoryMosque->name);
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

                    if ($user->mosque->endAssessment) {
                        $totalValue += $user->mosque->endAssessment->presentation_value;
                    }

                    if ($user->mosque->presentation && $user->mosque->presentation->startAssessment) {
                        $totalValue += $user->mosque->presentation->startAssessment->presentation_file;
                    }

                    $user->totalNilai = $totalValue + $user->mosque->total_pillar_value;
                    return $user;
                })->filter(function ($user) {
                    return $user->totalNilai > 0;
                });

                $topUsers = $users->sortByDesc('totalNilai');
                $allUsers = $allUsers->merge($topUsers);
            }
        }

        return $allUsers;
    }

    public function startCell(): string
    {
        return 'B2';
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

        $presentationValue = $user->mosque->endAssessment ? $user->mosque->endAssessment->presentation_value : 'Belum Tersedia';

        return [
            $this->index,
            $user->name,
            $user->mosque->company->name,
            $user->mosque->name,
            $pillarTwoValue,
            $pillarOneValue,
            $pillarThreeValue,
            $pillarFourValue,
            $pillarFiveValue,
            $filePresentationValue,
            $presentationValue,
            $user->totalNilai,
        ];
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA LENGKAP',
            'PERUSAHAAN',
            'NAMA MASJID/MUSALA',
            'HUBUNGAN DENGAN YAYASAN AMALIAH ASTRA',
            'HUBUNGAN MANAJEMEN PERUSAHAAN DENGAN DKM & JAMAAH',
            'PROGRAM SOSIAL',
            'ADMINISTRASI & KEUANGAN',
            'PERIBADAHAN & INFRASTRUKTUR',
            'FILE PRESENTASI',
            'PRESENTASI',
            'TOTAL NILAI',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('B1:M1');
        $sheet->setCellValue('B1', $this->title);
        $sheet->getRowDimension(1)->setRowHeight(40);

        $sheet->getRowDimension(2)->setRowHeight(30);
        $sheet->getStyle('C2:M2')->getAlignment()->setIndent(1);

        $lastDataRow = $sheet->getHighestRow();
        for ($rowIndex = 3; $rowIndex <= $lastDataRow; $rowIndex++) {
            $sheet->getRowDimension($rowIndex)->setRowHeight(20);
            $sheet->getStyle('C' . $rowIndex . ':M' . $rowIndex)->getAlignment()->setIndent(1);
        }

        $sheet->getStyle('B2:M' . $lastDataRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [
            'B1:M1' => [
                'font' => ['bold' => true, 'size' => 14, 'color' => ['argb' => 'FF000000']],
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
            ],
            'B2:M2' => [
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
            'H' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'I' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'J' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'K' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'L' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
            'M' => ['alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true]],
        ];
    }

    public function title(): string
    {
        return 'Penilaian Akhir';
    }
}
