<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ReturnSale;
use Faker\Generator as Faker;

$factory->define(ReturnSale::class, function (Faker $faker) {
    return [
        'date'          => $faker->date($format = 'Y-m-d', $max = 'now'),
        'member_id'     => \App\Member::all()->random()->id,
        'branch_id'     => \App\Branch::all()->random()->id,
        'biller_id'     => \App\Biller::all()->random()->id,
        'product_id'    => \App\Product::all()->random()->id,
        'supplier_id'   => \App\Supplier::all()->random()->id,
        'total'         => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
    ];
});
