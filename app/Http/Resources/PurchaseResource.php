<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'reference_no' => $this->reference_no,
            'name' => $this->name,
            'description' => $this->description,
            'active' => $this->active,
            'paid' => $this->paid,
            'total_qty' => $this->total_qty,
            'sub_total' => $this->sub_total,
            'purchase_status' => $this->purchase_status,
            'payment_status' => $this->payment_status,
            'created_at' => $this->created_at->toDateString(),
            'supplier' => $this->supplier,
            'products' => $this->products,
            'supplier' => $this->supplier,
            'branch' => $this->branch,
        ];
    }
}
