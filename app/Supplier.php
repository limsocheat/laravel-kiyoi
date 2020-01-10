<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
	protected $fillable = ['name', 'description', 'company_name', 'email', 'phone', 'address', 'vat_number', 'post_code', 'city', 'purchase_id', 'country'];

    public function purchase()
    {
    	return $this->belongsTo(\App\Purchase::class);
    }
    public function return_sales()
    {
        return $this->hasMany(\App\ReturnSale::class);
    }
}
