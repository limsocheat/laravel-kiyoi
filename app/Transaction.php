<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['account_id', 'credit', 'debit', 'total_balance'];

    public function account()
    {
    	return $this->belongsTo(\App\Account::class);
    }

    public function deposit()
    {
    	return $this->belongsTo(\App\DepositAccount::class);
    }
}
