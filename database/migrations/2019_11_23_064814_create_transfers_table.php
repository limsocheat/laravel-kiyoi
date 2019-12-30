<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('branch_id');
            $table->string('reference_no')->nullable();
            $table->double('shipping_charge')->nullable();
            $table->string('from_location');
            $table->string('to_location');
            $table->string('status')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('branches')
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
        Schema::dropIfExists('transfers');
    }
}
