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
}
