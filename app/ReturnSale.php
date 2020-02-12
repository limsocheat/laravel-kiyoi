<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnSale extends Model
{
    protected $fillable = [
        'id',
        'member_id',
        'branch_id',
        'account_id',
        'active',
        'return_des',
        'staff_des',
        'product_id',
    ];

    protected $appends = ['grand_total', 'total_quantity', 'total_price', 'total_discount', 'sub_total'];

    
    public function branch()
    {
        return $this->belongsTo(\App\Branch::class, 'branch_id');
    }
    public function member()
    {
        return $this->belongsTo(\App\Member::class, 'member_id');
    }
    public function account()
    {
        return $this->belongsTo(\App\Account::class, 'account_id');
    }
    public function products()
    {
    	return $this->belongsToMany(\App\Product::class)->withPivot('quantity', 'unit_price', 'discount');
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
    

    // For Calculate Total of each Row Principle
    // (product.unit_price - (product.unit_price * product.discount) / 100) * product.quantity
    public function getGrandTotalAttribute()
    {   

        $sum = array();

        foreach($this->products as $product) {
            $sum[] = ($product->pivot->unit_price - ($product->pivot->unit_price * $product->pivot->discount) / 100) * $product->pivot->quantity;
        }

        return array_sum($sum);
    }

}