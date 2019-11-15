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
        User::insert([
            [
                'name'      => 'administrator',
                'email'     => 'admin@mail.com',
                'password'  => bcrypt('secret')
            ]
        ]);
    }
}
