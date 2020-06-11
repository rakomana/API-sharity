<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\UUID;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, UUID;

 
    protected $fillable = [
        'name','lname','phone','type', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

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

    public function curriculum()
    {
        return $this->belongsTo(Currim::class);
    }
   
    public function posts()
    {
        return $this->hasMany('App\post');
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
