<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

	protected $fillable = [
        'name', 'description', 'active', 'code', 'type', 'barcode', 'unit', 'price', 'user_id', 'order_id', 'sale_id', 'brand_id', 'image'
    ];

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }


    public function purchases()
    {
    	return $this->hasMany(\App\Purchase::class);
    }

    public function order()
    {
    	return $this->belongsToMany(\App\Order::class);
    }

    public function transfers()
    {
        return $this->belongsToMany(\App\Transfer::class);
    }

    public function sale()
    {
        return $this->belongsTo(\App\Sale::class);
    }

    public function brand()
    {
        return $this->belongsTo(\App\Brand::class, 'brand_id');
    }
    public function return_sales()
    {
        return $this->belongTo(\App\ReturnSale::class);
    }
}
