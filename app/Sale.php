<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
		'description', 'active', 'sale_status', 'payment_status', 'total', 'paid', 'due', 'member_id', 'user_id'
	];

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }

    public function member()
    {
    	return $this->belongsTo(\App\Member::class);
    }

    public function products()
    {
        return $this->hasMany(\App\Product::class);
    }
}
