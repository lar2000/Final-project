<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id',
        'book_date',
        'rent_date',
        'room_id',
        'cust_id',
        'user_id',
    ];
}
