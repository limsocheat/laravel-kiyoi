<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
	protected $fillable = ['date', 'checkin', 'checkout', 'description', 'status', 'employee_name', 'employee_id'];

    public function employee()
    {
		return $this->belongsTo(\App\Employee::class);    	
    }
}
