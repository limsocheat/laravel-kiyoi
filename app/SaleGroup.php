<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleGroup extends Model
{
    protected $fillable = ['name', 'description'];

    public function users()
    {
        return $this->hasMany(\App\User::class);
    }
}
