<?php

use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ExpenseCategory::class, 5)->create()->each(function ($expense_category) {
        	$expense = factory(\App\Expense::class)->make();
        	$expense_category->expense()->save($expense);
        });
    }
}
