<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejare', function (Blueprint $table) {
            $table->id();
            $table->integer('rahn');
            $table->integer('ejare');
            $table->integer('file_id');
            $table->tinyInteger('ghabel_tabdil')->default(0);
            $table->date('tarikh_tahvil');
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
        Schema::dropIfExists('ejare');
    }
}
