<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Change to id() instead of id('user_id')
            $table->string('user_id')->unique(); // Change to id() instead of id('user_id')
            $table->string('firstName', 20);
            $table->string('lastName', 20);
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phoneNumber', 20);
            $table->string('profile_path')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
