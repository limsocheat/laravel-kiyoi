<?php

namespace App\Exports;

use App\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExpensesExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Expense::all();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Referrence No',
            'Category',
            'Amount',
            'Expense For',
            'Note',
        ];
    }


    public function map($row): array
    {
        return [
            [
                $row->created_at,
                $row->reference_no,
                $row->expense_category->name,
                '$ ' . $row->amount,
                $row->user->first_name,
                $row->description,
            ],
        ];
    }

}
