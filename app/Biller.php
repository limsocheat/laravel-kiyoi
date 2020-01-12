<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biller extends Model
{
    protected $fillable = [
    	'image', 'name', 'company_name', 'vat_number', 'email', 'phone', 'address', 'city', 'country', 'description'
    ];
    public function return_sales()
    {
        return $this->hasMany(\App\ReturnSale::class);
    }
}
