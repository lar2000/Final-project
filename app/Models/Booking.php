<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'book_id';

    protected $fillable = [
        'book_date',
        'book_enddate',
        'room_number',
        'cust_id',
        'book_pay',
    ];
    
}
