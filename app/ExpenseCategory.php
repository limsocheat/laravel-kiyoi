<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $fillable = ['code', 'name', 'description'];

    protected $appends = ['total_expense'];

    public function expenses()
    {
    	return $this->hasMany(\App\Expense::class);
    }


    // Sum all of amount of each Category
    public function getTotalExpenseAttribute()
    {
        $sum = 0;

        foreach($this->expenses as $expense) {
            // dd($expense->name);
            $sum = $sum + $expense->amount;
        }

        return $sum;
    }
}
