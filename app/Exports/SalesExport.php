<?php

namespace App\Exports;

use App\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class SalesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sale::with(['member'])->get();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Invoice No',
            'Customer',
            'Payment Status',
            'Grand Total',
            'Paid',
            'Due',
        ];
    }

    public function map($row): array
    {
        // dd($row);
        return [
            $row->created_at,
            $row->reference_no,
            $row->member->name,
             $row->payment_status,
            '$'. $row->grand_total,
            '$'. $row->paid,
            '$' . $row->due,
        ];
    }
}
