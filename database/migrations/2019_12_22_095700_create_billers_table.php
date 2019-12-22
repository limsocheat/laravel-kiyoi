<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billers', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('name');    
            $table->string('email');    
            $table->string('phone');    
            $table->string('address');    
            $table->text('description')->nullable();    
            $table->boolean('active')->default(1);    
            $table->string('company_name');   
            $table->string('vat_number')->nullable();    
            $table->string('city')->nullable();    
            $table->string('country')->nullable();    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billers');
    }
}
