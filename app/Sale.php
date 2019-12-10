<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	protected $fillable = [
		'description', 'active', 'sale_status', 'payment_status', 'total', 'paid', 'due',
	];

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }

    public function customer()
    {
    	return $this->belongsTo(\App\Customer::class);
    }
}
