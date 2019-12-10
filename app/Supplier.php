<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function purchases()
    {
    	return $this->hasMany(\App\Purchase::class);
    }
}
