<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    return [
    	'user_id' => \App\User::all()->random()->id,
        'code' => $faker->postcode,
        'description' => $faker->text,
        'active' => $faker->randomElement(['1', '0']),
        'debit' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
        'balance' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
    ];
});
