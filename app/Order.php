<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

	protected $fillable = [
		'name', 'unit_cost', 'discount', 'member_id',
	];

    public function member()
    {
        return $this->belongsTo(\App\Member::class);
    }

    public function products()
    {
        return $this->belongsToMany(\App\Product::class, 'order_id');
    }
}
