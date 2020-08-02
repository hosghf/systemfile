<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('family')->nullable();
            $table->string('username')->nullable();
            $table->tinyInteger('role_id')->unsigned()->default('3');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table){
            $table->foreign('role_id')->references('id')->on('roles');
        });

        \App\Models\User::create(
            [
                'id' => 1,
                'username' => 'admin',
                'name' => 'admin',
                'family' => 'admin',
                'role_id' => '2',
                'password' => Hash::make('admin')
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
        Schema::dropIfExists('users');
    }
}
