<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DepositAccount;
use Faker\Generator as Faker;

$factory->define(DepositAccount::class, function (Faker $faker) {
    return [
        'member_id' => \App\Member::all()->random()->id,
        'amount' => $faker->randomFloat(2, 100, 100000),
    ];
});
