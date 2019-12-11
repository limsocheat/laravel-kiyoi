<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $fillable = ['expense_id', 'code', 'name', 'description'];

    public function expense()
    {
    	return $this->belongsTo(\App\Expense::class, 'expense_id');
    }
}
