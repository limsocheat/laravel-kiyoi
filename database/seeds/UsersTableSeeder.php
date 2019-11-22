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
