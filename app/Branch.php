<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }

    public function purchases()
    {
    	return $this->hasMany(\App\Purchase::class);
    }

    public function transfers()
    {
    	return $this->hasMany(\App\Transfer::class);
    }
}
