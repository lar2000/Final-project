<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'room_number',
        'date_start',
        'date_end',
        'cust_id',
        'room_price',
    ];
}

