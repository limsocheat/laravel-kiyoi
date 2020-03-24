<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;


class Expense extends Model
{
	protected $fillable = ['date', 'description', 'amount', 'category_id', 'user_id', 'expense_for'];

    protected $appends = ['created'];

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }

    public function expense_category()
    {
    	return $this->belongsTo(\App\ExpenseCategory::class);
    }


    public function getCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->toDateString();
    }
}
