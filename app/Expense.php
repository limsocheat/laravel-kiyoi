<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
	protected $fillable = ['description', 'amount', 'category_id', 'user_id'];

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }

    public function expense_category()
    {
    	return $this->belongsTo(\App\ExpenseCategory::class);
    }
}
