<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    public function employee()
    {
    	return $this->belongsTo(\App\Employee::class);
    }

    public function account()
    {
    	return $this->belongsTo(\App\Account::class);
    }
}
