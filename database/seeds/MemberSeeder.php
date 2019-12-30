<?php

use Illuminate\Database\Seeder;

use App\Sale;

use Faker\Factory;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Member::class, 5)->create();

        $faker = Factory::create();

        foreach(range(1, 5) as $i) {
            Sale::create([
                'user_id' => \App\User::all()->random()->id,
        // 'branch_id' => \App\Branch::all()->random()->id,
                'member_id' => \App\Member::all()->random()->id,
                // 'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'description' => $faker->text,
                'active' => $faker->randomElement(['1', '0']),
                'reference_no' => 'SA/' . date('Y') . $i,
                'sale_status' => $faker->randomElement(['completed']),
                'payment_status' => $faker->randomElement(['Paid', 'Pending']),
                'total' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
                'paid' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
                'due' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
            ]);
        }
    }
}
