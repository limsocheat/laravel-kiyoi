<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'active' => $faker->randomElement(['1', '0']),
        'code' => $faker->randomNumber($nbDigits = NULL, $strict = false),
        'type' => $faker->randomElement(['New', 'Old', 'Second Hand']),
        'barcode' => $faker->creditCardNumber,
        'category' => $faker->randomElement(['Fruits', 'Toys', 'Electrics', 'Foods']),
        'unit' => $faker->numberBetween($min=1, $max=1000),
        'price' => $faker->numberBetween($min=10, $max=10000),
    ];
});
