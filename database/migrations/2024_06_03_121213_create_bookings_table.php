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
        Schema::create('bookings', function (Blueprint $table) {
            $table->string('book_id');
            $table->date('book_date');
            $table->date('book_enddate');
            $table->unsignedBigInteger('room_number');
            $table->unsignedBigInteger('cust_id');
            $table->enum('status', ['ຈອງແລ້ວ', 'ບໍ່ຫວ່າງ', 'ຫວ່າງ'])->change();
            $table->string('book_pay');
            $table->timestamps();

            $table->foreign('room_number')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('cust_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
