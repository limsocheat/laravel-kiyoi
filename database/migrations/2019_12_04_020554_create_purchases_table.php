<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('order_id');
            $table->string('reference_no')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('active')->default(1);
            // $table->string('supplier');
            $table->double('paid');
            $table->string('purchase_status');
            $table->string('payment_status');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')
                                                ->onDelete('cascade')
                                                ->onUpdate('cascade');

            $table->foreign('branch_id')->references('id')->on('branches')
                                                ->onDelete('cascade')
                                                ->onUpdate('cascade');

            $table->foreign('order_id')->references('id')->on('orders')
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
        Schema::dropIfExists('purchases');
    }
}
