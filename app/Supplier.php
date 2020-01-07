<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
	protected $fillable = ['name', 'description', 'company_name', 'email', 'phone', 'address', 'vat_number', 'post_code', 'city', 'country'];

    public function products()
    {
    	return $this->hasMany(\App\Product::class);
    }
}
