<?php

namespace App\Imports;

use App\Purchase;
use Maatwebsite\Excel\Concerns\ToModel;

class PurchaseImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Purchase([
            'created_at' => $row[0],
            'reference_no' => $row[1],
            'supplier' => $row[2],
            'purchase_status' => $row[3],
            'payment_status' => $row[4],
        ]);
    }
}
