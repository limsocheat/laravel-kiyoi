<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ReturnPurchase;
use Faker\Generator as Faker;

$factory->define(ReturnPurchase::class, function (Faker $faker) {
    return [
        // 'branch_id'     => \App\Branch::all()->random()->id,
        // 'supplier_id'   => \App\Supplier::all()->random()->id,
        // 'account_id'    => \App\Account::all()->random()->id,
        // 'active'        => $faker->randomElement(['1', '0']),
        // 'return_des'    => $faker->text,
        // 'staff_des'     => $faker->text,
        // 'reference_no'  => 'pr-'.date('Ymd').date('Hi'),
        // 'product_id' => \App\Product::all()->random()->id,
    ];
});
