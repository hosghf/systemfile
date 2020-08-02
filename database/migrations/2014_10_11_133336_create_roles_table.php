<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
//            $table->id();
            $table->tinyInteger('id')->autoIncrement()->unsigned();
            $table->string('title');
            $table->timestamps();
        });
        \App\Models\Role::create(
            [
                'id' => 1,
                'title' => 'developer',
            ]
        );
        \App\Models\Role::create(
            [
                'id' => 2,
                'title' => 'admin',
            ]
        );
        \App\Models\Role::create(
            [
                'id' => 3,
                'title' => 'moshaver',
            ]
        );
        \App\Models\Role::create(
            [
                'id' => 4,
                'title' => 'moshaverForosh',
            ]
        );
        \App\Models\Role::create(
            [
                'id' => 5,
                'title' => 'moshaverEjare',
            ]
        );
        \App\Models\Role::create(
            [
                'id' => 6,
                'title' => 'monshi',
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
