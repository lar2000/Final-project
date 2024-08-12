<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_checkouts_table.php
public function up()
{
    Schema::create('checkouts', function (Blueprint $table) {
        $table->id('checkout_id');
        $table->string('rent_id');
        $table->string('room_number');
        $table->string('cust_name');
        $table->date('date_checkout');
        $table->timestamps();
    });
}

};
