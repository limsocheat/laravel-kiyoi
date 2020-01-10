<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnSale extends Model
{
    protected $fillable = [
        'member_id',
        'branch_id',
        'product_id',
        'biller_id',
        'supplier_id',
        'id',
        'date',
        'total',
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
    public function products()
    {
        return $this->hasMany(\App\Product::class, 'product_id');
    }
    public function supplier()
    {
        return $this->belongsTo(\App\Supplier::class, 'supplier_id');
    }
}
