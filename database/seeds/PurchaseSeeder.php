<?php

use Illuminate\Database\Seeder;

use App\Purchase;

use Faker\Factory;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  = Factory::create();

        foreach(range(1, 5) as $i) {
        	Purchase::create([
        		'product_id' => \App\Product::all()->random()->id,
		        'branch_id' => \App\Branch::all()->random()->id,
		        'order_id' => \App\Order::all()->random()->id,
		        // 'date' => $faker->date($format = 'Y-m-d', $max = 'now')
                // 'supplier_id' => \App\Supplier::all()->random()->id,
		        'reference_no' => 'pr-' . date('Ymd-') . date('His'),
		        'name' => $faker->name,
		        'description' => $faker->text,
		        'active' => $faker->randomElement(['1', '0']),
		        // 'supplier' => $faker->name,
		        // 'total' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
		        'paid' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
		        'purchase_status' => $faker->randomElement(['Received']),
		        'payment_status' => $faker->randomElement(['Due', 'Paid']),
        	]);
        }
    }
}
