<?php

use App\ReturnSale;
use Illuminate\Database\Seeder;
use Faker\Factory;

class ReturnSaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ReturnSale::class , 10)->create();
        // $faker = Factory::create();

        // foreach(range(1,10) as $i){
        //     ReturnSale::create([
        //         'date'          => $faker->date($format = 'Y-m-d', $max = 'now'),
        //         'member_id'     => \App\Member::all()->random()->id,
        //         'branch_id'     => \App\Branch::all()->random()->id,
        //         'biller_id'     => \App\Biller::all()->random()->id,
        //         'product_id'    => \App\Product::all()->random()->id,
        //         'total'         => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
        //     ]);
        // }
    }
}
