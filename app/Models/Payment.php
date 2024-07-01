<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'pay_id',
        'roomtype_id',
        'room_number',
        'rent_id',
        'month_year',
        'room_price',
        'ele_price',
        'water_price',
        'gar_price',
    ];
}
