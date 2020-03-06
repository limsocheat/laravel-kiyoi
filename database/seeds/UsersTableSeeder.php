<?php

use App\User;
use Illuminate\Database\Seeder;

use Faker\Factory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();

        $users      = [
            // SuperAdmin
            [
                'name'      => "superAdmin",
                "email"     => "superadmin@mail.com",
                "password"  => 'secret',
            ],
            // Admin
            [
                'name'      => "administrator",
                "email"     => "administrator@mail.com",
                "password"  => 'secret',
            ],
            [
                'name'      => "accountant",
                "email"     => "accountant@mail.com",
                "password"  => 'secret',
            ],
            [
                'name'      => "saleManager",
                "email"     => "saleManager@mail.com",
                "password"  => 'secret',
            ],
            [
                'name'      => "saleman",
                "email"     => "saleman@mail.com",
                "password"  => 'secret',
            ],

            // Web Admin
            [
                'name'      => "technician",
                "email"     => "technician@mail.com",
                "password"  => 'secret',
            ],

            // SuperVisor
            [
                'name'      => "supervisor",
                "email"     => "supervisor@mail.com",
                "password"  => 'secret',
            ],
            // Member
            [
                'name'      => "member",
                "email"     => "member@mail.com",
                "password"  => 'secret',
            ],
        ];

        foreach ($users as $user) :
            User::create([
                'name'      => $user['name'],
                'email'     =>  $user['email'],
                'password'  => bcrypt($user['password']),
                'referral_code' => strtoupper(substr(uniqid(mt_rand(), true), 0, 8))
            ]);
        endforeach;
    }
}
