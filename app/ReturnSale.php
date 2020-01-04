<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnSale extends Model
{
    protected $fillable = [
        'member_id',
        'branch_id',
        'product_id',
        'id',
        'date',
        'biller_id',
        'total',
        'member_name',
        'biller_name',
        'branch_name'
    ];

    public function member(){
        return $this->belongsTo(\App\Member::class);
    }
    public function biller(){
        return $this->belongsTo(\App\Biller::class);
    }
    public function branch(){
        return $this->belongsTo(\App\Branch::class);
    }
    public function products(){
        return $this->belongsTo(\App\Product::class);
    }
}
