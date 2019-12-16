<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
      'name', 'description', 'gender', 'phone',
    ];

    public function attendance()
    {
    	return $this->hasOne(\App\Attendance::class);
    }

    public function holidays()
    {
    	return $this->hasMany(\App\Holiday::class);
    }

    public function payrolls()
    {
        return $this->hasMany(\App\Payroll::class);
    }

    public function department()
    {
    	return $this->belongsTo(\App\Department::class);
    }
}
