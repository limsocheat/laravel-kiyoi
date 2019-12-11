<?php

use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Expense::class,5)->create()->each(function ($expense) {
        	$expense_category = factory(\App\ExpenseCategory::class)->make();
        	$expense->expense_category()->save($expense_category);

        });
    }
}
