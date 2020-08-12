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
            $table->integer('user_id')->unsigned();
            $table->integer('rahn')->nullable();
            $table->integer('ejare')->nullable();
            $table->bigInteger('price')->nullable();
            $table->integer('metr')->nullable();
            $table->tinyInteger('street_id')->unsigned()->nullable();
            $table->text('tozihat')->nullable();
            $table->tinyInteger('forosh')->nullable();
            $table->timestamps();
        });

        Schema::table('customers', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('customers', function (Blueprint $table){
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
        Schema::dropIfExists('customer');
    }
}
