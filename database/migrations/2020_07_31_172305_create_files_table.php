<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('family');
            $table->string('phone');
            $table->tinyInteger('street_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('address')->nullable();
            $table->tinyInteger('cat_id')->unsigned()->default(1);
            $table->integer('metr')->unsigned()->nullable();
            $table->float('price',10,2)->nullable();
            $table->float('rahn')->nullable();
            $table->float('ejare')->nullable();
            $table->tinyInteger('forosh')->default('1');
            $table->tinyInteger('maskoni')->nullable();
            $table->integer('year')->nullable();
            $table->tinyInteger('cabinet_id')->nullable()->unsigned();
            $table->tinyInteger('floor_id')->unsigned()->nullable();
            $table->tinyInteger('room_id')->unsigned()->nullable();
            $table->tinyInteger('tabaghe_id')->unsigned()->nullable();
            $table->tinyInteger('heating_id')->unsigned()->nullable();
            $table->tinyInteger('cooling_id')->unsigned()->nullable();
            $table->tinyInteger('sanad_id')->unsigned()->nullable();
            $table->tinyInteger('direction_id')->unsigned()->nullable();
            $table->tinyInteger('parking')->nullable();
            $table->tinyInteger('anbari')->nullable();
            $table->tinyInteger('asansor')->nullable();
            $table->tinyInteger('archive')->default('0');
            $table->tinyInteger('private')->default('0');
            $table->tinyInteger('kole_tabaghat')->unsigned()->nullable();
            $table->text('tozihat')->nullable();
            $table->timestamps();
        });
        Schema::table('files', function (Blueprint $table){
            $table->foreign('street_id')->references('id')->on('streets');
        });
        Schema::table('files', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('files', function (Blueprint $table){
            $table->foreign('cabinet_id')->references('id')->on('cabinets');
        });
        Schema::table('files', function (Blueprint $table){
            $table->foreign('cat_id')->references('id')->on('categories');
        });
        Schema::table('files', function (Blueprint $table){
            $table->foreign('floor_id')->references('id')->on('floors');
        });
        Schema::table('files', function (Blueprint $table){
            $table->foreign('heating_id')->references('id')->on('heatings');
        });
        Schema::table('files', function (Blueprint $table){
            $table->foreign('cooling_id')->references('id')->on('coolings');
        });
        Schema::table('files', function (Blueprint $table){
            $table->foreign('sanad_id')->references('id')->on('sanad');
        });
        Schema::table('files', function (Blueprint $table){
            $table->foreign('direction_id')->references('id')->on('building_directions');
        });
        Schema::table('files', function (Blueprint $table){
            $table->foreign('tabaghe_id')->references('id')->on('tabaghe');
        });
        Schema::table('files', function (Blueprint $table){
            $table->foreign('room_id')->references('id')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
