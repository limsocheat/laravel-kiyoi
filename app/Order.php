<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

	protected $fillable = [
		'name', 'quantity', 'unit_cost', 'discount', 'tax', 'sub_total'
	];

    public function customer()
    {
        return $this->belongsTo(\App\Customer::class);
    }

    public function purchases()
    {
    	return $this->hasMany(\App\Purchase::class);
    }

    public function order_items()
    {
        return $this->hasMany(\App\OrderItem::class);
    }
}
