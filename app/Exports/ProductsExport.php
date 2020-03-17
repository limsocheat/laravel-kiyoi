<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Code',
            'Unit',
            'Price',
        ];
    }

    public function map($row): array
    {
        // dd($row);
        return [
            $row->name,
            $row->code,
            $row->unit,
            $row->price,
        ];
    }
}
