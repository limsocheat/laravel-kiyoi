<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Quotation;
use Faker\Generator as Faker;

$factory->define(Quotation::class, function (Faker $faker) {
    return [
        'members_id'        => \App\Member::all()->random()->id,
        'date'              => $faker->date($format = 'Y-m-d', $max = 'now'),
        'members'           => $faker->name,
        'suppliers'         => $faker->name,
        'active'            => $faker->randomElement(['1', '0']),
        'total'             => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
        'quotation_status'  => $faker->randomElement(['Sent', 'Pending']),
    ];
});