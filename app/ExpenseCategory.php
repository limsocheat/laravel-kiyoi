<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $fillable = ['code', 'name', 'description'];

    public function expense()
    {
    	return $this->hasOne(\App\Expense::class);
    }
}
