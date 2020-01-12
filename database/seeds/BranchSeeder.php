<?php

use Illuminate\Database\Seeder;

use App\Branch;

use Faker\Factory;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Factory::create();

    	$location = ['Heng Heng', 'Cute Shop'];

    	foreach($location as $i) {
    		Branch::create([
                'user_id' => \App\User::all()->random()->id,
    			'name' => $i,
    			'address' => $faker->address,
    			'city' => $faker->city,
    			'country' => $faker->country,
    		]);
    	}
    }
}
