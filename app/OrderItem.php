<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
   	protected $fillable = ['active', 'description', 'quantity', 'discount', 'unit_price'];

   	public function order()
   	{
   		return $this->belongsTo(\App\Order::class);
   	}


   	public function product()
   	{
   		return $this->belongsTo(\App\Product::class);
   	}
}
