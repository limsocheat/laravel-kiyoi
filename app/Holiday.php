<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
	protected $fillable = ['from_date', 'to_date', 'employee_id'];
	
    public function employee()
    {
    	return $this->belongsTo(\App\Employee::class);
    }
}
