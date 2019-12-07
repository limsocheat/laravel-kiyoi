<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

	protected $fillable = [
		'name', 'quantity', 'unit_cost', 'discount', 'tax', 'sub_total'
	];

    public function purchases()
    {
    	return $this->hasMany(\App\Purchase::class);
    }

    public function Product()
    {
    	return $this->hasMany(\App\Product::class);
    }
}
