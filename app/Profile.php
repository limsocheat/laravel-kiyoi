<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'phone', 'address', 'city', 'country'];

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }
}
