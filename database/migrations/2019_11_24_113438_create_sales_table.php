<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->text('description')->nullable();
            $table->boolean('active')->default(1);
            $table->string('reference_no')->nullable();
            // $table->enum('payment_status', ['paid', 'due'])->nullable();
            $table->string('payment_method');
            $table->string('shipping_cost')->default(0)->nullable();
            $table->integer('discount')->default(0)->nullable();
            $table->double('paid');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
