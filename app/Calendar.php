<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $fillable = ['title', 'description', 'start', 'end', 'color'];

    public function user()
    {
    	# code...
    	return $this->belongsTo(\App\User::class);
    }
}
