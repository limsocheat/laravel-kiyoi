<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	protected $fillable = [
		'active', 'name', 'code' , 'description', 'debit', 'balance'
	];

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }


    public function payrolls()
    {
    	return $this->hasMany(\App\Payroll::class);
    }
}
