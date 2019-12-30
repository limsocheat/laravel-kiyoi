<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
	protected $fillable = ['reference_no', 'from_location', 'to_location', 'status', 'description', 'branch_id', 'product_id'];

    public function branch()
    {
    	return $this->belongsTo(\App\Branch::class);
    }

    public function products()
    {
    	return $this->belongsToMany(\App\Product::class)->withPivot('unit_price', 'quantity');
    }
}
