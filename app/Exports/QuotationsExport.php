<?php

namespace App\Exports;

use App\Quotation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class QuotationsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Quotation::all();
    }

    public function headings() : array
    {
        return [
            'Date', 'Reference No', 'Biller', 'Customer', 'Supplier', 'Status', 'Grandtotal'
        ];
    }

    public function map($row) : array
    {
        return [
            $row->created_at,
            $row->reference_no,
            $row->reference_no,
            $row->biller->name,
            $row->supplier->name,
            $row->status,
            '$ ' . $row->grand_total,
        ];
    }
}
