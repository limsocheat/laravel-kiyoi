<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ExpenseCategory;
use Faker\Generator as Faker;

$factory->define(ExpenseCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
