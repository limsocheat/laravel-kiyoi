<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
		'user_id', 'name', 'company_name', 'email', 'tax', 'post_code', 'phone', 'address', 'city', 'country'
	];

	protected $appends = ['deposit_amount'];

	public function user()
	{
		return $this->belongsTo(\App\User::class);
	}

	public function sales()
	{
		return $this->hasMany(\App\Sale::class);
	}

	public function deposits()
	{
		return $this->hasMany(\App\DepositAccount::class);
	}

	public function getDepositAmountAttribute()
	{
		return $this->deposits()->sum('amount');
	}
	public function return_sales()
	{
		return $this->hasMany(\App\ReturnSale::class);
	}
	public function quotations()
	{
		return $this->hasMany(\App\Quotation::class);
	}
}
