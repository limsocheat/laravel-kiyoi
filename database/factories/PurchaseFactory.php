<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Purchase;
use Faker\Generator as Faker;

$factory->define(Purchase::class, function (Faker $faker) {
    return [
        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'name' => $faker->name,
        'description' => $faker->text,
        'active' => $faker->randomElement(['1', '0']),
        'supplier' => $faker->name,
        'total' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
        'paid' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
        'purchase_status' => $faker->randomElement(['Received']),
        'payment_status' => $faker->randomElement(['Due', 'Paid']),
    ];
});
