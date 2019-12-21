<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'account_id' => \App\Account::all()->random()->id,
        'deposit_account_id' => \App\DepositAccount::all()->random()->id,
        'credit' => $faker->randomFloat(2, 1000, 10000),
        'debit' => $faker->randomFloat(2, 100, 1000),
        // 'total_balance' => $faker->randomFloat(2, 10000, 1000000),
    ];
});
