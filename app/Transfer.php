<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
	protected $fillable = ['reference_no', 'from_location', 'to_location', 'status', 'description', 'branch_id', 'product_id'];

    protected $appends = ['total_quantity', 'sub_total', 'grand_total'];

    public function branch()
    {
    	return $this->belongsTo(\App\Branch::class);
    }

    public function products()
    {
    	return $this->belongsToMany(\App\Product::class)->withPivot('unit_price', 'quantity');
    }

    // Calculate Quantity for Show Transfer Detail Page
    public function getTotalQuantityAttribute()
    {
        $sum = array();
        foreach($this->products as $product) {
            $sum[] =  $product->pivot->quantity;
        }

        return array_sum($sum);
    }

    // Calculate Sub Total for Show Transfer Detail Page
    public function getSubTotalAttribute()
    {
        $sum = array();
        foreach($this->products as $product) {
            $sum[] = $product->pivot->unit_price;
        }

        return array_sum($sum);
    }


    // Calculate Sub Total for Show Transfer Detail Page
    public function getGrandTotalAttribute()
    {
        $sum = array();
        foreach($this->products as $product) {
            $sum[] = $product->pivot->unit_price + $product->shipping_charge;
        }

        return array_sum($sum);
    }
}
