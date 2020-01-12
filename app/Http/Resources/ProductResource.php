<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'code' => $this->code,
            'type' => $this->type,
            'barcode' => $this->barcode,
            'category' => $this->category,
            'unit' => $this->unit,
            'cost' => $this->cost,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'order' => $this->order,
            'user' => $this->user,
            'transfers' => $this->transfers,
            'brand' => $this->brand,
            'image' => $this->image,
            'orders' => $this->orders,
        ];
    }
}
