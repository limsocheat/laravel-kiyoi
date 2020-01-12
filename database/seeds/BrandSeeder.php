<?php

use Illuminate\Database\Seeder;

use App\Brand;

use Faker\Factory;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        foreach (range(1, 5) as $i) {
        	Brand::create([
                'name' => $faker->name,
        		'description' => $faker->sentence,
        	]);
        }
    }
}
