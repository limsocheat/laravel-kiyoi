<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'member_id',
        'biller_id',
        'product_id',
        'supplier_id',
        'branch_id',
        'status',
        'reference_no',
        'active',
        'description',
        'file',
        'shipping_cost',

    ];

    // protected $appends = ['grand_total', 'due_amount', 'total_quantity', 'total_price', 'total_discount', 'sub_total', 'payment_status'];
    
    protected $appends = ['grand_total', 'total_quantity', 'total_price', 'total_discount', 'sub_total'];


    public function member()
    {
        return $this->belongsTo(\App\Member::class , 'member_id');
    }

    public function supplier()
    {
        return $this->belongsTo(\App\Supplier::class , 'supplier_id');
    }

    public function biller()
    {
        return $this->belongsTo(\App\Biller::class , 'biller_id');
    }

    public function branch()
    {
        return $this->belongsTo(\App\Branch::class , 'branch_id');
    }

    public function products()
    {
        return $this->belongsToMany(\App\Product::class)->withPivot('quantity','unit_price','discount');
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
    
    public function getGrandTotalAttribute()
    {   

        $s = array();

        foreach($this->products as $product) {
            $s[] = ($product->pivot->unit_price - ($product->pivot->unit_price * $product->pivot->discount) / 100) * $product->pivot->quantity;
        }

        return array_sum($s);
    }


    // For Payment Method

   

}