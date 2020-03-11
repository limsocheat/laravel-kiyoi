<?php

// Product Category

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'code', 'description', 'active'];

    public function products()
    {
    	return $this->hasMany(\App\Product::class);
    }
}
