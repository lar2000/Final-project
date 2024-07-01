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
            $table->string('room_number');
            $table->unsignedBigInteger('roomtype_id');
            $table->enum('status', ['ຈອງແລ້ວ', 'ບໍ່ຫວ່າງ', 'ຫວ່າງ'])->change();
            $table->timestamps();
        
            $$table->foreign('roomtype_id')->references('id')->on('roomstypes')->onDelete('cascade');
            
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
