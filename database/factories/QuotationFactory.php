<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Quotation;
use Faker\Generator as Faker;

$factory->define(Quotation::class, function (Faker $faker) {
    return [
        // 'member_id'     => \App\Member::all()->random()->id,
        // 'supplier_id'   => \App\Supplier::all()->random()->id,
        // 'biller_id'     => \App\Biller::all()->random()->id,
        // 'branch_id'     => \App\Branch::all()->random()->id,
        // 'active'        => $faker->randomElement(['1', '0']),
        // 'status'        => $faker->randomElement(['Sent', 'Pending']),
        // 'description'   => $faker->text,
        // 'product_id'    => \App\Product::all()->random()->id,
        // 'reference_no'  => 'PR'.date('Ymd').date('His'),
    ];
});