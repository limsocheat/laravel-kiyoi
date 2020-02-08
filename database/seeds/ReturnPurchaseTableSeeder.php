<?php

use Illuminate\Database\Seeder;
use App\ReturnPurchase;
use Faker\Factory;


class ReturnPurchaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(\App\ReturnPurchase::class , 10)->create();
        $faker  = Factory::create();

        foreach(range(1, 5) as $i) {
        	ReturnPurchase::create([
		        'branch_id'     => \App\Branch::all()->random()->id,
                'supplier_id'   => \App\Supplier::all()->random()->id,
                'account_id'    => \App\Account::all()->random()->id,
                'active'        => $faker->randomElement(['1', '0']),
                'return_des'    => $faker->text,
                'staff_des'     => $faker->text,
                'product_id' => \App\Product::all()->random()->id,
                'reference_no'  => 'PR'.date('Y') .'000'. $i,
               
        	]);
        }
    }
}
