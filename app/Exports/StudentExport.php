<?php

namespace App\Exports;


use App\Domain\Students\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
//    /**
//     * @var mixed
//     */
//    public mixed $request_id;
//
//    /**
//     * @param $request_id
//     */
//    public function __construct($request_id)
//    {
//        $this->request_id = $request_id;
//    }


    /**
     * @return Builder[]|Collection
     */
    public function collection()
    {
        return Student::query()
            ->get()
            ->sortBy('fio');
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            [
                'FIO','Guruh','Telefon raqam','Yo\'nalish','Fan','Ro\'yxatdan o\'tgan sana'
            ],
        ];
    }


    public function map($row): array
    {
        return [
            $row->fio,
            $row->group,
            $row->phone,
            $row->subjects->pluck('specialities')->flatten()->pluck('name')->unique()->join(', '),
            $row->subjects->pluck('name')->join(', '),
            $row->created_at,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                /** @var Worksheet $sheet */
                $sheet = $event->sheet->getDelegate();

                // Merge header cells
                $sheet->mergeCells('A1:A2');
                $sheet->mergeCells('B1:B2');
                $sheet->mergeCells('C1:C2');
                $sheet->mergeCells('D1:D2');
                $sheet->mergeCells('E1:E2');
                $sheet->mergeCells('F1:F2');

                // Style header
                $sheet->getStyle('A1:F2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);

                $sheet->getStyle('A2:F' . $sheet->getHighestRow())->applyFromArray([
                    'alignment' => [
                        'wrapText' => true,
                        'vertical' => Alignment::VERTICAL_JUSTIFY,
                    ],
                ]);

                for ($row = 2; $row <= $sheet->getHighestRow(); $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(30);
                }

                foreach (range('A', 'F') as $columnID) {
                    $sheet->getColumnDimension($columnID)
                        ->setAutoSize(true);
                }
            },
        ];
    }
}
