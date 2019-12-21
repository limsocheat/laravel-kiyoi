<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    return [
    	'member_id' => \App\Member::all()->random()->id,
        'code' => $faker->postcode,
        'name' => $faker->name,
        'description' => $faker->text,
        'active' => $faker->randomElement(['1', '0']),
        // 'debit' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
        'balance' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
    ];
});
