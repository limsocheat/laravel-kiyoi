<?php

use Illuminate\Database\Seeder;

class ReturnSaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ReturnSale::class , 5)->create();
    }
}
