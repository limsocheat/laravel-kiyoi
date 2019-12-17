<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	protected $fillable = ['name', 'description', 'user_id'];

	public function user()
	{
		return $this->belongsTo(\App\User::class);
	}

    public function employee()
    {
    	return $this->hasOne(\App\Employee::class);
    }
}
