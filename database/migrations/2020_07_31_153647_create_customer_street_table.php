<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerStreetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_street', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('street_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
        });

        Schema::table('customer_street', function (Blueprint $table){
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
        Schema::table('customer_street', function (Blueprint $table){
            $table->foreign('street_id')->references('id')->on('streets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_street');
    }
}
