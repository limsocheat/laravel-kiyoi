<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Expense;
use Faker\Generator as Faker;

$factory->define(Expense::class, function (Faker $faker) {
    return [
        'category' => $faker->randomElement(['Electric Bill', 'Washing', 'Snack']),
        'warehouse' => $faker->randomElement(['warehouse1', 'warehouse2']),
        'amount' => $faker->numberBetween($min=100, $max=10000),
    ];
});
