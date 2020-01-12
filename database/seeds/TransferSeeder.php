<?php

use Illuminate\Database\Seeder;

use App\Transfer;
use Faker\Factory;
// use Haruncpi\LaravelIdGenerator\IdGenerator;


class TransferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        // Transfer::truncate();

        // $id = IdGenerator::generate(['table' => 'transfers', 'field' => 'reference_no', 'length' => 11, 'prefix' => 'ST/' . date('Y')]);


        foreach(range(1, 5) as $i) {
        	Transfer::create([
        		'branch_id' => \App\Branch::all()->random()->id,
        		// 'reference_no' => $id,
        		'from_location' => $faker->company,
        		'to_location' => $faker->company,
        		'status' => $faker->randomElement(['Pending', 'Sent', 'Completed']),
        	]);
        }
    }
}
