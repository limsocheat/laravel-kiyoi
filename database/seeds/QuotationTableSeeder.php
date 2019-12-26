<?php

use Illuminate\Database\Seeder;

class QuotationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Quotation::class , 10)->create();
    }
}