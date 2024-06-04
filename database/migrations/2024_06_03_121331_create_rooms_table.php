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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('room_id');
            $table->string('room_number');
            $$table->foreign('room_type')->references('id')->on('roomstypes')->onDelete('cascade');
            $table->enum('status', ['ຈອງແລ້ວ', 'ບໍ່ຫວ່າງ', 'ຫວ່າງ'])->change();
            $table->integer('room_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
