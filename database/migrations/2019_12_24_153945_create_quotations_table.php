<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('members_id');
            $table->date('date');
            $table->string('members');
            $table->string('suppliers');
            $table->text('description')->nullable();
            $table->boolean('active')->default(1);
            $table->string('quotation_status');
            $table->double('total');
            $table->timestamps();

            $table->foreign('members_id')->references('id')->on('members')
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
        Schema::dropIfExists('quotations');
    }
}