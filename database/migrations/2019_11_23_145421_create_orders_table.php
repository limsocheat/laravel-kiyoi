<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->string('name');
            $table->unsignedBigInteger('code');
            $table->text('description')->nullable();
            $table->boolean('active')->default(1);
            $table->decimal('discount');
            $table->double('unit_price');
            $table->double('tax');
            $table->double('sub_total');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')
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
        Schema::dropIfExists('orders');
    }
}
