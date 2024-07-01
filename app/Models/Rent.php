<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;
    protected $fillable = [
        'rent_id',
        'date_start',
        'date_end',
        'book_id',
        'room_number',
        'cust_id',
        'user_id',
        'room_price',
    ];
}
