<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('book_id');
            $table->date('book_date');
            $table->date('book_enddate');
            $table->string('room_number');
            $table->integer('cust_id');
            $table->string('book_pay');
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}

