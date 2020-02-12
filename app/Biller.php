<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biller extends Model
{
    protected $fillable = [
    	'image', 'name', 'company_name', 'vat_number', 'email', 'phone', 'address', 'city', 'country', 'description'
    ];
    public function quotations()
    {
        return $this->hasMany(\App\Quotation::class);
    }
}
