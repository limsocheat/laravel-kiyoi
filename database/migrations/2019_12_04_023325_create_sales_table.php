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
            $table->date('date');
            $table->text('description')->nullable();
            $table->boolean('active')->default(1);
            $table->string('sale_status');
            $table->string('payment_status');
            $table->double('total');
            $table->double('paid');
            $table->double('due');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('member_id')->references('id')->on('members')
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
        Schema::dropIfExists('sales');
    }
}
