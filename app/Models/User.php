<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject; 
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
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
    // ---------------  ເພີ່ມ script ນີ້ ---------------------
    /**
                    * Get the identifier that will be stored in the subject claim of the JWT.
                    *
                    * @return mixed
                    */
                    public function getJWTIdentifier()
                    {
                        return $this->getKey();
                    }

                    /**
                    * Return a key value array, containing any custom claims to be added to the JWT.
                    *
                    * @return array
                    */
                    public function getJWTCustomClaims()
                    {
                        return [];
                    }

}
