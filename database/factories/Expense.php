<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Expense;
use Faker\Generator as Faker;

$factory->define(Expense::class, function (Faker $faker) {
    return [
    	'user_id' => \App\User::all()->random()->id,
    	'expense_category_id' => \App\ExpenseCategory::all()->random()->id,
        'category' => $faker->randomElement(['Electric Bill', 'Cleaning']),
        'description' => $faker->text,
        'active' => $faker->randomElement(['1', '0']),
        'amount' => $faker->numberBetween($min=100, $max=10000),
    ];
});
