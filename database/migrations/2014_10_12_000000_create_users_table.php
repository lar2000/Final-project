<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->unique(); // Unique user identifier
            $table->string('firstName', 200);
            $table->string('lastName', 200);
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phoneNumber', 30);
            $table->string('profile_path')->nullable(); // Profile path added here
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
