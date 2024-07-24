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
            $table->string('name', 20);
            $table->string('surname', 20);
            $table->string('gender', 10);
            $table->string('tell', 20); // Changed to string for phone number
            $table->string('address', 200); // Corrected column name to 'address'
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
