<?php

use Illuminate\Database\Seeder;

use App\Expense;

use Faker\Factory;


class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Factory::create();


    	foreach(range(1, 10) as $i) {
    		Expense::create([
    			'user_id' => \App\User::all()->random()->id,
		    	'expense_category_id' => \App\ExpenseCategory::all()->random()->id,
		        'reference_no' => 'ER' . date('Y') . '/000' . $i,
		        // 'description' => $faker->text,
		        'active' => $faker->randomElement(['1', '0']),
		        'amount' => $faker->numberBetween($min=100, $max=10000),
    		]);
    	}
        
    }
}
