<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    public function branch()
    {
    	return $this->belongsTo(\App\Branch::class);
    }
}
