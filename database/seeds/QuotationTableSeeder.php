<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Quotation;

class QuotationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(\App\ReturnPurchase::class , 5)->create();
        $faker  = Factory::create();

        foreach(range(1, 5) as $i) {
        	Quotation::create([
		        'member_id'     => \App\Member::all()->random()->id,
                'supplier_id'   => \App\Supplier::all()->random()->id,
                'biller_id'     => \App\Biller::all()->random()->id,
                'branch_id'     => \App\Branch::all()->random()->id,
                'active'        => $faker->randomElement(['1', '0']),
                'status'        => $faker->randomElement(['Sent', 'Pending']),
                'description'   => $faker->text,
                'reference_no'  => 'PR'.date('Y') .'000'. $i,
                // 'total'         => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
                'product_id'    => \App\Product::all()->random()->id,
        	]);
        }
    }
}