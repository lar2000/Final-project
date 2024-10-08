<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roomtype extends Model
{
    use HasFactory;

    protected $fillable = [
        'roomtype_id',
        'roomtype_name',
        'room_price',
    ];
    public function rooms()
    {
        return $this->hasMany(Room::class, 'roomtype_id');
    }
}
