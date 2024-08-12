<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    // Define the table associated with the model if it's not the plural form of the model name
    protected $table = 'checkouts';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'checkout_id';

    // Indicate that the primary key is not auto-incrementing
    public $incrementing = false;

    // Disable timestamps if your table does not have 'created_at' and 'updated_at' columns
    public $timestamps = false;

    // Define which attributes are mass assignable
    protected $fillable = [
        'rent_id',
        'room_number',
        'cust_name',
        'date_checkout',
    ];
}

