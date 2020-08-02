<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('family');
            $table->string('phone');
            $table->bigInteger('user_id')->unsigned();
            $table->tinyInteger('rahn')->nullable();
            $table->tinyInteger('ejare')->nullable();
            $table->tinyInteger('price')->nullable();
            $table->tinyInteger('metr')->nullable();
            $table->tinyInteger('room')->nullable();
            $table->tinyInteger('tabaghe')->nullable();
            $table->tinyInteger('forosh')->nullable();
            $table->tinyInteger('maskoni')->nullable();
            $table->timestamps();
        });

        Schema::table('customers', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
