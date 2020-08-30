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
            $table->float('rahn')->nullable();
            $table->float('ejare')->nullable();
            $table->float('price',10,2)->nullable();
            $table->integer('metr')->nullable();
            $table->text('tozihat')->nullable();
            $table->tinyInteger('forosh')->nullable();
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
