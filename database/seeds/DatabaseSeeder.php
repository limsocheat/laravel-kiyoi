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
            MemberSeeder::class,
            OrderSeeder::class,
            BranchSeeder::class,
            TransferSeeder::class,
            ProductSeeder::class,
            ExpenseCategorySeeder::class,
            ExpenseSeeder::class,
            PurchaseSeeder::class,
            AccountSeeder::class,
            DepartmentSeeder::class,
            HolidaySeeder::class,
            PayrollSeeder::class,
            AttendanceSeeder::class,
            SupplierSeeder::class,
            DepositAccountSeeder::class,
            TransactionSeeder::class,
            BillerSeeder::class,
        ]);
    }
}
