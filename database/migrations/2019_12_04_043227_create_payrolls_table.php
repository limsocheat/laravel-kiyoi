<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('account_id');
            $table->string('employee_name');
            $table->text('description')->nullable();
            $table->boolean('active')->default(1);
            $table->string('account_name');
            $table->double('amount');
            $table->string('method');
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')
                                        ->onDelete('cascade')
                                        ->onUpdate('cascade');;
            $table->foreign('account_id')->references('id')->on('accounts')
                                        ->onDelete('cascade')
                                        ->onUpdate('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payrolls');
    }
}
