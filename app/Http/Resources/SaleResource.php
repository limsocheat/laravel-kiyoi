<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            'date' => $this->date,
            'description' => $this->description,
            'active' => $this->active,
            'sale_status' => $this->sale_status,
            'payment_status' => $this->payment_status,
            'total' => $this->total,
            'paid' => $this->paid,
            'due' => $this->due,
            'created_at' => $this->created_at->toDateTimeString(),
            'user' => $this->user,
            'customer' => $this->customer,
        ];
    }
}
