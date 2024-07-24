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
            
            $table->id('pay_id');
            $table->integer('roomtype_id');
            $table->string('room_number');
            $table->date('month_year', 12);
            $table->string('rent_id');
            $table->integer('room_price');
            //ຄ່າໄຟ
           
            $table->integer('ele_price');

            //ຄ່ານໍ້າ
           
            $table->integer('water_price');
            //ຄ່າຂີ້ເຫຍື້ອ
            $table->integer('gar_price');
            $table->timestamps();
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
