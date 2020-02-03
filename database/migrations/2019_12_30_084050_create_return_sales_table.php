<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->boolean('active')->default(1);
            $table->string('reference_no')->nullable();
            $table->text('return_des')->nullable();
            $table->text('staff_des')->nullable();
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members')
                                        ->onDelete('cascade')
                                        ->onUpdate('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')
                                        ->onDelete('cascade')
                                        ->onUpdate('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')
                                        ->onDelete('cascade')
                                        ->onUpdate('cascade');  
            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');  
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('return_sales');
    }
}