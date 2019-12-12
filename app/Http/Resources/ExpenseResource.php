<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            'category' => $this->category,
            'description' => $this->description,
            'active' => $this->active,
            'amount' => $this->amount,
            'expense_for' => $this->expense_for,
            'created_at' => $this->created_at->toDateTimeString(),
            'user' => $this->user,
            'expense_category' => $this->expense_category,
        ];
    }
}
