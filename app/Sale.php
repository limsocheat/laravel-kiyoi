<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
		'description', 'active', 'payment_status', 'total', 'paid', 'due', 'member_id', 'user_id', 'branch_id'
	];

    protected $appends = ['grand_total'];

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }

    public function member()
    {
    	return $this->belongsTo(\App\Member::class);
    }

    public function products()
    {
        return $this->belongsToMany(\App\Product::class)->withPivot('quantity', 'discount', 'unit_price');
    }

    public function branch()
    {
        return $this->belongsTo(\App\Branch::class);
    }

    // (product.unit_price - (product.unit_price * product.discount) / 100) * product.quantity

    public function getGrandTotalAttribute()
    {   

        $s = array();

        foreach($this->products as $product) {
            $s[] = ($product->pivot->unit_price - ($product->pivot->unit_price * $product->pivot->discount) / 100) * $product->pivot->quantity;
        }

        return array_sum($s);
    }
}
