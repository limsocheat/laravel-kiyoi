<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
   	public function user()
   	{
   		return $this->belongsTo(\App\User::class);
   	}

   	public function sales()
   	{
   		return $this->hasMany(\App\Sale::class);
   	}

   	
}
