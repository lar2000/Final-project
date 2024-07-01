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
        'book_enddate',
        'room_number',
        'cust_id',
        'status',
        'book_pay',
    ];
}
