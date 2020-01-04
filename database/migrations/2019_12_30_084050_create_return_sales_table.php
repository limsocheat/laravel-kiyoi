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
            $table->unsignedBigInteger('biller_id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('product_id');
            $table->date('date');
            $table->string('biller_name');
            $table->string('member_name');
            $table->string('branch_name');
            $table->double('total');
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members')
                                        ->onDelete('cascade')
                                        ->onUpdate('cascade');
            $table->foreign('biller_id')->references('id')->on('billers')
                                        ->onDelete('cascade')
                                        ->onUpdate('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')
                                        ->onDelete('cascade')
                                        ->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')
                                        ->onDelete('cascade')
                                        ->onUpdate('cascade');        
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
