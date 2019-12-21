<?php

use Illuminate\Database\Seeder;

class DepositAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\DepositAccount::class, 5)->create();
    }
}
