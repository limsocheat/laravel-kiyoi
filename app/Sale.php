<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
		'description', 'active', 'payment_status', 'total', 'paid', 'due', 'member_id', 'user_id', 'branch_id'
	];

    protected $appends = ['grand_total', 'due_amount', 'total_quantity', 'total_price', 'total_discount', 'sub_total'];

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

    // Calculate Sub Total for Show Sale Detail Page
    public function getSubTotalAttribute()
    {
        $sum = array();
        foreach($this->products as $product) {
            $sum[] = ($product->pivot->unit_price - ($product->pivot->unit_price * $product->pivot->discount) / 100) * $product->pivot->quantity;
        }

        return array_sum($sum);
    }

    // Calculate Quantity for Show Sale Detail Page
    public function getTotalQuantityAttribute()
    {
        $sum = array();
        foreach($this->products as $product) {
            $sum[] =  $product->pivot->quantity;
        }

        return array_sum($sum);
    }

    // Calculate Discount for Show Sale Detail Page
    public function getTotalDiscountAttribute()
    {
        $sum = array();
        foreach($this->products as $product) {
            $sum[] =  $product->pivot->discount;
        }

        return array_sum($sum);
    }

    // Calculate All of Unit Price for Show Sale Detail Page
    public function getTotalPriceAttribute()
    {
        $sum = array();
        foreach($this->products as $product) {
            $sum[] =  $product->pivot->unit_price;
        }

        return array_sum($sum);
    }
    
    // Calculate Due Amount in All Sale Page
    public function getDueAmountAttribute()
    {
        return $this->getGrandTotalAttribute() - $this->paid;
    }

    // For Calculate Total of each Row Principle
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
