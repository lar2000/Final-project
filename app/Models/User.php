<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'firstName',
        'lastName',
        'gender',
        'email',
        'password',
        'phoneNumber',
        'profile_path',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
