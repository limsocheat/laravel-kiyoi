<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

	protected $fillable = [
		'name', 'description', 'active',  'shipping_cost', 'branch_id', 'supplier_id', 'purchase_status', 'payment_status', 'unit_price', 'quantity', 'discount'
	];


    public function products()
    {
    	return $this->belongsToMany(\App\Product::class)->withPivot('quantity', 'unit_price', 'discount');
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
