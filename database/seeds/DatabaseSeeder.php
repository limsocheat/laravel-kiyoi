<?php

use App\Quotation;
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
            ProductSeeder::class,
            BranchSeeder::class,
            ExpenseCategorySeeder::class,
            ExpenseSeeder::class,
            PurchaseSeeder::class,
            AccountSeeder::class,
            DepartmentSeeder::class,
            HolidaySeeder::class,
            PayrollSeeder::class,
            AttendanceSeeder::class,
            OrderItemSeeder::class,
            SupplierSeeder::class,
            DepositAccountSeeder::class,
            TransactionSeeder::class,
            BillerSeeder::class,
            TransferSeeder::class,
            QuotationTableSeeder::class,
        ]);
    }
}
