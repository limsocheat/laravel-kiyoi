<?php

use Illuminate\Database\Seeder;

use App\Product;

use Faker\Factory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        // Product::truncate();

        // foreach (range(1,5) as $i) {
        //     Product::create([
        //         'user_id' => \App\User::all()->random()->id,
        //         'brand_id' => \App\Brand::all()->random()->id,
        //         'name' => $faker->randomElement(['Apple', 'PC', 'LapTop', 'Monitor']),
        //         // 'image' => $faker->image('public/image', 50, 50, null, false),
        //         'active' => $faker->randomElement(['1', '0']),
        //         'code' => $faker->randomNumber($nbDigits = NULL, $strict = false),
        //         'barcode' => $faker->creditCardNumber,
        //         'unit' => $faker->numberBetween($min=1, $max=1000),
        //         'price' => $faker->numberBetween($min=10, $max=10000),
        //     ]);
        // }

        Product::create([
            'user_id' => \App\User::all()->random()->id,
            'category_id' => 1,
            'name' => "PREMIUM ACTIVE HYDROGEN ALKALINE WATER FILTER KY-807/811",
            'image' => '/products/indoor_1.jpg',
            'active' => $faker->randomElement(['1', '0']),
            'code' => $faker->randomNumber($nbDigits = NULL, $strict = false),
            'barcode' => $faker->creditCardNumber,
            'unit' => $faker->numberBetween($min = 1, $max = 1000),
            'price' => $faker->numberBetween($min = 10, $max = 10000),
            'description' => '<div class="wpb_wrapper">
			<p>One of our best core products. Very efficient, technologically advanced Japanese indoor water filter, dedicated to bigger families and businesses.</p>
<ul>
<li>11 platinum plates in the filtering system</li>
<li>1000 liters of filtered water per hour</li>
<li>handle filtering of heavily contaminated water</li>
<li>very rich in long-lasting active hydrogen (it stays in up to 7 days)</li>
<li>&nbsp;4 levels of water alkalinity &amp; 2 levels of water acidity</li>
<li>pH from 3 to 11</li>
<li>modern and useful display menu</li>
<li>self cleaning option</li>
</ul>

		</div>',
        ]);

        Product::create([
            'user_id' => \App\User::all()->random()->id,
            'category_id' => 1,
            'name' => "ACTIVE HYDROGEN ALKALINE WATER FILTER KY-605/607 M",
            'image' => '/products/indoor_2.jpg',
            'active' => $faker->randomElement(['1', '0']),
            'code' => $faker->randomNumber($nbDigits = NULL, $strict = false),
            'barcode' => $faker->creditCardNumber,
            'unit' => $faker->numberBetween($min = 1, $max = 1000),
            'price' => $faker->numberBetween($min = 10, $max = 10000),
            'description' => '<div class="wpb_wrapper">
			<p>Another excellent core model in our offer. Technologically advanced Japanese compact indoor water filter for everyone – individuals and smaller families.</p>
<ul>
<li>&nbsp;5 platinum plates in the filtering system</li>
<li>&nbsp;600 liters of filtered water per hour</li>
<li>&nbsp;recommended for medium-contaminated water</li>
<li>rich in active hydrogen (it stays in up to 3 days)</li>
<li>&nbsp;4 levels of water alkalinity &amp; 2 levels of water acidity</li>
<li>pH from 3 to 11</li>
<li>modern and useful display menu</li>
<li>&nbsp;self cleaning option</li>
</ul>

		</div>',
        ]);

        Product::create([
            'user_id' => \App\User::all()->random()->id,
            'category_id' => 1,
            'name' => "6-STAGE FILTER",
            'image' => '/products/indoor_3.jpg',
            'active' => $faker->randomElement(['1', '0']),
            'code' => $faker->randomNumber($nbDigits = NULL, $strict = false),
            'barcode' => $faker->creditCardNumber,
            'unit' => $faker->numberBetween($min = 1, $max = 1000),
            'price' => $faker->numberBetween($min = 10, $max = 10000),
            'description' => '<div class="wpb_wrapper">
			<p>Multifunctional, automatic Japanese indoor filter, fitting any kind of property. It suits both – individuals and families.</p>
<ul>
<li>ultra filtration super membrane</li>
<li>&nbsp;filtering traces up to 0.01 micron</li>
<li>&nbsp;600 liters of filtered water per hour</li>
<li>&nbsp;recommended for medium-contaminated water</li>
<li>&nbsp;high-quality clean water</li>
<li>basic alkaline water option (pH up to 8)</li>
<li>simple in use</li>
</ul>

		</div>',
        ]);

        Product::create([
            'user_id' => \App\User::all()->random()->id,
            'category_id' => 2,
            'name' => "MASTER FILTER",
            'image' => '/products/outdoor_1.jpg',
            'active' => $faker->randomElement(['1', '0']),
            'code' => $faker->randomNumber($nbDigits = NULL, $strict = false),
            'barcode' => $faker->creditCardNumber,
            'unit' => $faker->numberBetween($min = 1, $max = 1000),
            'price' => $faker->numberBetween($min = 10, $max = 10000),
            'description' => '<div class="wpb_wrapper">
			<p>Our best automatic Japanese outdoor filter for every property, possible to be installed in any available area. Extremely efficient and easy to maintain. For individuals and families.</p>
<ul>
<li>ultra filtration membrane</li>
<li>filtering traces up to 0.01 micron</li>
<li>3000 liters of filtered water per hour</li>
<li>recommended for medium-contaminated water</li>
<li>high-quality clean water</li>
<li>one filter for the whole property</li>
<li>simple in use</li>
</ul>

		</div>',
        ]);
    }
}
