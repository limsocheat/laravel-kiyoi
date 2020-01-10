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
    }
}
