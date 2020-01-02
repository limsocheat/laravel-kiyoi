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
            $table->unsignedBigInteger('members_id');
            $table->unsignedBigInteger('biller_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            // $table->unsignedBigInteger('product_id');
            $table->date('date');
            $table->string('biller_name')->nullable();
            $table->string('member_name')->nullable();
            $table->string('branch_address')->nullable();
            $table->double('total');
            $table->timestamps();

            $table->foreign('members_id')->references('id')->on('members')
                                        ->onDelete('cascade')
                                        ->onUpdate('cascade');

            $table->foreign('biller_id')->references('id')->on('billers')
                                        ->onDelete('cascade')
                                        ->onUpdate('cascade');
           
            $table->foreign('branch_id')->references('id')->on('branches')
                                        ->onDelete('cascade')
                                        ->onUpdate('cascade');

            // $table->foreign('product_id')->references('id')->on('products')
            //                             ->onDelete('cascade')
            //                             ->onUpdate('cascade');
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
