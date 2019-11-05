<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('photo',50)->default('static/dist/img/avatar5.png');
            $table->string('username');
            $table->string('email',50)->unique();
            $table->string('password');
            $table->json('address');
            $table->string('phone');
            $table->enum('gender',['L','P']);
            $table->date('birthday');
            $table->enum('role',['admin','member']);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
