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
                'first_name'      => "superAdmin",
                'last_name'      => "superAdmin",
                "email"     => "superadmin@mail.com",
                "password"  => 'secret',
            ],
            // Admin
            [
                'first_name'      => "administrator",
                'last_name'      => "administrator",
                "email"     => "administrator@mail.com",
                "password"  => 'secret',
            ],
            [
                'first_name'      => "accountant",
                'last_name'      => "accountant",
                "email"     => "accountant@mail.com",
                "password"  => 'secret',
            ],
            [
                'first_name'      => "saleManager",
                'last_name'      => "saleManager",
                "email"     => "saleManager@mail.com",
                "password"  => 'secret',
            ],
            [
                'first_name'      => "saleman",
                'last_name'      => "saleman",
                "email"     => "saleman@mail.com",
                "password"  => 'secret',
            ],

            // Web Admin
            [
                'first_name'      => "technician",
                'last_name'      => "technician",
                "email"     => "technician@mail.com",
                "password"  => 'secret',
            ],

            // SuperVisor
            [
                'first_name'      => "supervisor",
                'last_name'      => "supervisor",
                "email"     => "supervisor@mail.com",
                "password"  => 'secret',
            ],
            // Member
            [
                'first_name'      => "member",
                'last_name'      => "member",
                "email"     => "member@mail.com",
                "password"  => 'secret',
            ],
        ];

        foreach ($users as $user) :
            User::create([
                'first_name'      => $user['first_name'],
                'last_name'      => $user['last_name'],
                'email'     =>  $user['email'],
                'password'  => bcrypt($user['password']),
                'referral_code' => strtoupper(substr(uniqid(mt_rand(), true), 0, 8))
            ]);
        endforeach;
    }
}
