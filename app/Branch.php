<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    protected $fillable = ['name', 'description', 'address', 'city', 'country'];

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }

    public function purchases()
    {
    	return $this->hasMany(\App\Purchase::class);
    }

    public function transfers()
    {
    	return $this->hasMany(\App\Transfer::class);
    }

    public function return_sales()
    {
        return $this->hasMany(\App\ReturnSale::class);
    }

    public function return_purchases()
    {
        return $this->hasMany(\App\ReturnPurchase::class);

    }
    public function sales()
    {
        return $this->hasMany(\App\Sale::class);
    }
    public function quotations()
    {
        return $this->hasMany(\App\Quotation::class);
    }
}
