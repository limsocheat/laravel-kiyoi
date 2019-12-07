<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'customer_id' => \App\Customer::all()->random()->id,
        'name' => $faker->name,
        'code' => $faker->randomNumber($nbDigits = NULL),
        'description' => $faker->text,
        'active' => $faker->randomElement(['1', '0']),
        'quantity' => $faker->numberBetween($min=1, $max=100),
        'unit_cost' => $faker->randomFloat(2, 10, 200),
        'discount' => $faker->randomElement(['0.1', '0.2', '0.5']), 
        'sub_total' => $faker->randomFloat(2, 1000, 200000),
    ];
});
