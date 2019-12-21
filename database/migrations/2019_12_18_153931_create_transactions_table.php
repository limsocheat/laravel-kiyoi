<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('deposit_account_id');
            $table->double('credit')->nullable();
            $table->double('debit')->nullable();
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')
                                                ->onDelete('cascade')
                                                ->onUpdate('cascade');

            $table->foreign('deposit_account_id')->references('id')->on('deposit_accounts')
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
        Schema::dropIfExists('transactions');
    }
}
