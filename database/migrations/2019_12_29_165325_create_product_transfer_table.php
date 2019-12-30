<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_transfer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transfer_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->text('description')->nullable();
            $table->boolean('active')->default(1);
            $table->double('unit_price');
            $table->integer('quantity')->default(1);
            $table->timestamps();

            $table->foreign('transfer_id')->references('id')->on('transfers')->onDelete('set null');
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
        Schema::dropIfExists('product_transfer');
    }
}
