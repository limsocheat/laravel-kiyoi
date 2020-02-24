<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

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

            [
                'name'      => "saleman2",
                "email"     => "saleman2@mail.com",
                "password"  => 'secret',
            ],

            // Web Admin
            [
                'name'      => "webAdmin",
                "email"     => "webAdmin@mail.com",
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
                'password'  => bcrypt($user['password'])
            ]);
        endforeach;
    }
}
