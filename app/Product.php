<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class Product extends Model
{

	protected $fillable = [
        'name', 'description', 'active', 'code', 'type', 'barcode', 'unit', 'price', 'user_id', 'order_id', 'sale_id', 'brand_id', 'image'
    ];


    use LogsActivity;

    protected $appends = ['user_name', 'type'];

    protected static $logAttributes = ['name', 'user_name', 'type'];

    // public function tapActivity(Activity $activity, string $eventName)
    // {
    //     $activity->description = "Product {$eventName}";
    // }

    public function getTypeAttribute()
    {
        return 'Product ';
    }

    public function getUserNameAttribute()
    {
        if(auth()->check() === true) {
            return auth()->user()->name;
        }
    }

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }


    public function purchases()
    {
    	return $this->belongsToMany(\App\Purchase::class)->withPivot('quantity', 'unit_price');
    }

    public function orders()
    {
    	return $this->belongsToMany(\App\Order::class)->withPivot('quantity', 'unit_price');
    }

    public function transfers()
    {
        return $this->belongsToMany(\App\Transfer::class);
    }

    public function sales()
    {
        return $this->belongsToMany(\App\Sale::class)->withPivot('quantity', 'unit_price');
    }

    public function brand()
    {
        return $this->belongsTo(\App\Brand::class, 'brand_id');
    }

    public function return_sales()
    {
        return $this->belongsToMany(\App\ReturnSale::class)->withPivot('quantity', 'unit_price');
    }
    public function return_purchases()
    {
        return $this->belongsToMany(\App\ReturnPurchase::class)->withPivot('quantity', 'unit_price');
    }
    public function quotations()
    {
        return $this->belongsToMany(\App\Quotation::class)->withPivot('quantity', 'unit_price','discount');
    }
}
