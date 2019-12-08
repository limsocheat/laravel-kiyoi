<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderItem;
use Faker\Generator as Faker;

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
    	'order_id' => \App\Order::all()->random()->id,	
    	'product_id' => \App\Product::all()->random()->id,	
        'description' => $faker->text,
        'active' => $faker->randomElement(['1', '0']),
        'quantity' => $faker->numberBetween($min=1, $max=100),
        'unit_price' => $faker->randomFloat(2, 10, 200),
        'discount' => $faker->randomElement(['0.1', '0.2', '0.5']), 
    ];
});
