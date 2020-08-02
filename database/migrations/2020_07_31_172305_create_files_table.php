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
            $table->bigInteger('user_id')->unsigned();
            $table->string('address')->nullable();
            $table->tinyInteger('type_id')->unsigned()->default(1);
            $table->tinyInteger('metr')->unsigned()->nullable();
            $table->integer('price')->nullable();
            $table->tinyInteger('forosh')->default('1');
            $table->tinyInteger('maskoni')->nullable();
            $table->tinyInteger('year')->nullable();
            $table->tinyInteger('cabinet_id')->nullable()->unsigned();
            $table->tinyInteger('floor_id')->unsigned()->nullable();
            $table->tinyInteger('room')->unsigned()->nullable();
            $table->tinyInteger('tabaghe')->unsigned()->nullable();
            $table->tinyInteger('heating_id')->unsigned()->nullable();
            $table->tinyInteger('cooling_id')->unsigned()->nullable();
            $table->tinyInteger('sanad_id')->unsigned()->nullable();
            $table->tinyInteger('direction_id')->unsigned()->nullable();
            $table->tinyInteger('parking')->unsigned()->nullable();
            $table->tinyInteger('anbari')->unsigned()->nullable();
            $table->tinyInteger('asansor')->unsigned()->nullable();
            $table->tinyInteger('vahed_dar_tabaghe')->unsigned()->nullable();
            $table->string('tozihat')->nullable();
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
            $table->foreign('type_id')->references('id')->on('type_of_lands');
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
