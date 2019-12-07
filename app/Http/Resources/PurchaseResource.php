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
            // 'id' => $this->id,
            // 'name' => $this->name,
            // 'description' => $this->description,
            // 'active' => $this->active,
            // 'supplier' => $this->supplier,
            // 'total' => $this->total,
            // 'paid' => $this->paid,
            // 'purchase_status' => $this->purchase_status,
            // 'payment_status' => $this->payment_status,
            // 'created_at' => $this->created_at,
            // 'product' => $this->product,
        ];
    }
}
