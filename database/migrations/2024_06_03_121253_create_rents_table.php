<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentsTable extends Migration
{
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id('rent_id');
            $table->integer('book_id');
            $table->string('room_number');
            $table->date('date_start');
            $table->date('date_end');
            $table->integer('cust_id');
            $table->decimal('room_price', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rents');
    }
}
