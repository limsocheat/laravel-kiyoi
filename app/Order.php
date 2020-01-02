<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

	protected $fillable = [
		'name', 'quantity', 'unit_cost', 'discount', 'tax', 'sub_total'
	];

    public function member()
    {
        return $this->belongsTo(\App\Member::class);
    }

    public function purchases()
    {
    	return $this->hasMany(\App\Purchase::class);
    }

    public function products()
    {
        return $this->belongsToMany(\App\Product::class, 'order_id');
    }
}
