<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

	protected $fillable = ['name', 'description', 'active', 'code', 'type', 'barcode', 'unit', 'price'];

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
    	return $this->belongsTo(\App\Order::class);
    }

    public function order_item()
    {
        return $this->hasOne(\App\OrderItem::class);
    }
}
