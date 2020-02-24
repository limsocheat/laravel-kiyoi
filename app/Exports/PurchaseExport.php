<?php

namespace App\Exports;

use App\Purchase;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PurchaseExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Purchase::with(['products', 'branch', 'supplier'])
                    ->orderBy('id', 'desc')
                    // ->take(100)    
                    ->get();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Reference No',
            'Supplier Name',
            'Shipping Cost',
            'Purchase Status',
            'Payment Status',
        ];
    }

    public function map($row): array
    {
        // dd($row);
        return [
            $row->created_at,
            $row->reference_no,
            $row->supplier->name,
            '$ ' . $row->shipping_cost,
            $row->purchase_status,
            $row->payment_status,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {  
                $cellRange = 'A1:F1'; // All headers
                $bodyRange = 'A';
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FFFF0000'],
                        ],
                    ],

                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'rotation' => 90,
                        'startColor' => [
                            'argb' => '263042',
                        ],
                        'endColor' => [
                            'argb' => '263042',
                        ],
                    ],
                ];
                


                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);

                $event->sheet->getDelegate()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(14);
                $event->sheet->getDelegate()->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(14);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(14);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(14);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(14);
            },
        ];
    }
}


