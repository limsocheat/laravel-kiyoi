<?php

namespace App\Exports;

use App\Department;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DepartmentsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Department::all();
    }

    public function headings() : array
    {
        return [
            'Department',
        ];
    }

    public function map($row) : array
    {
        return [
            $row->name,
        ];
    }
}
