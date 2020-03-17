<?php

namespace App\Exports;

use App\ExpenseCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExpensesCategoryExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ExpenseCategory::all();
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->code,
            $row->name,
        ];
    }


    public function headings(): array
    {
        return [
            '#',
            'Code',
            'Name',
        ];
    }

}
