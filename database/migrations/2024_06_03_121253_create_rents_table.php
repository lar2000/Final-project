<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->string('rent_id');
            $table->date('date_start');
            $table->date('date_end');
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('room_number');
            $table->unsignedBigInteger('cust_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('room_price');
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('room_number')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('cust_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
