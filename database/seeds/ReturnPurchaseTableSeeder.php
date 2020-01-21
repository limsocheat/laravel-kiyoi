<?php

use Illuminate\Database\Seeder;
use App\ReturnPurchase;

class ReturnPurchaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ReturnPurchase::class , 10)->create();
    }
}
