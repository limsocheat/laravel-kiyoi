<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];

    protected $fillable = ['event_name', 'description', 'from_date', 'to_date', 'color'];
}
