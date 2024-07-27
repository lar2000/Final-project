<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id('cust_id'); // Changed to bigIncrements
            $table->string('firstName', 200);
            $table->string('lastName', 200);
            $table->string('gender', 20);
            $table->string('phoneNumber', 20); // Changed to string for phone number// Corrected column name to 'address'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
}
