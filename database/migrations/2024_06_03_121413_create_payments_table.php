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
        Schema::create('payments', function (Blueprint $table) {
            
            $table->integer('pay_id');
            $table->unsignedBigInteger('roomtype_id');
            $table->unsignedBigInteger('room_number');
            $table->date('month_year', 12);
            $table->unsignedBigInteger('rent_id');
            $table->integer('room_price');
            //ຄ່າໄຟ
           
            $table->integer('ele_price');

            //ຄ່ານໍ້າ
           
            $table->integer('water_price');
            //ຄ່າຂີ້ເຫຍື້ອ
            $table->integer('gar_price');
            $table->timestamps();

            $table->foreign('rent_id')->references('id')->on('rents')->onDelete('cascade');
            $table->foreign('room_number')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('roomtype_id')->references('id')->on('roomtypes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
