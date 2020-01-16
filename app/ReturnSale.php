<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnSale extends Model
{
    protected $fillable = [
        'id',
        'member_id',
        'branch_id',
        'biller_id',
        'supplier_id',
        'account_id',
        'active',
        'return_des',
        'staff_des',
        'unit_price', 
        'quantity', 
        'discount',
        'product_id',
    ];
    
    public function branch()
    {
        return $this->belongsTo(\App\Branch::class, 'branch_id');
    }
    public function member()
    {
        return $this->belongsTo(\App\Member::class, 'member_id');
    }
    public function biller()
    {
        return $this->belongsTo(\App\Biller::class, 'biller_id');
    }
    
    public function supplier()
    {
        return $this->belongsTo(\App\Supplier::class, 'supplier_id');
    }
    public function account()
    {
        return $this->belongsTo(\App\Account::class, 'account_id');
    }
    public function products()
    {
    	return $this->belongsToMany(\App\Product::class)->withPivot('quantity', 'unit_price', 'discount');
    }
}