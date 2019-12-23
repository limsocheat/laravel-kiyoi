<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

	protected $fillable = [
		'name', 'date', 'description', 'active', 'supplier', 'total', 'paid', 'purchase_status', 'payment_status',
	];

    public function product()
    {
    	return $this->belongsTo(\App\Product::class);
    }

    public function order()
    {
    	return $this->belongsTo(\App\Order::class);
    }

    public function supplier()
    {
        return $this->belongsTo(\App\Supplier::class);
    }

    public function branch()
    {
        return $this->belongsTo(\App\Branch::class);
    }
}
