<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            RolePermissionTableSeeder::class,
            ProductSeeder::class,
            BranchSeeder::class,
            ExpenseSeeder::class,
            PurchaseSeeder::class,
            CustomerSeeder::class,
            AccountSeeder::class,
            DepartmentSeeder::class,
            HolidaySeeder::class,
        ]);
    }
}
