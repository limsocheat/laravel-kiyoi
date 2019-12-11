<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
	protected $fillable = ['description', 'date', 'amount', 'expense_for'];

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }

    public function expense_category()
    {
    	return $this->hasOne(\App\ExpenseCategory::class);
    }
}
