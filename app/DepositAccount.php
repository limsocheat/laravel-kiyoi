<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositAccount extends Model
{

	protected $fillable = ['description', 'amount', 'member_id'];

    public function member()
    {
    	return $this->belongsTo(\App\Member::class, 'member_id');
    }

    public function transaction()
    {
    	return $this->hasOne(\App\Transaction::class);
    }
}

