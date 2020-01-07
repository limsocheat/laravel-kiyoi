<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('supplier_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('active')->default(1)->nullable();
            $table->double('code')->nullable();
            $table->string('type')->nullable();
            $table->string('barcode')->nullable();
            $table->string('category')->nullable();
            $table->integer('unit')->default(1);
            $table->double('cost')->nullable();
            $table->string('image')->nullable();
            $table->double('price');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('order_id')->references('id')->on('orders');  
            $table->foreign('sale_id')->references('id')->on('sales')
                                            ->onDelete('cascade')
                                            ->onUpdate('cascade');  

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
