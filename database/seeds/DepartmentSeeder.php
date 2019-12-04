<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Department::class, 3)->create();
        factory(\App\Employee::class, 3)->create();
    }
}
