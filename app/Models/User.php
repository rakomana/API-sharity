<?php

namespace App\Models;

use App\Enums\MediaCollections;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\UUID;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, HasMedia
{
    use Notifiable, UUID, HasMediaTrait, HasRoles;

 
    protected $guarded;
    
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

    public function registerMediaCollections(): void
    {
        $this
        ->addMediaCollection(MediaCollections::ProfilePicture)
        ->useFallbackUrl(url('/images/profile-picture-placeholder.jpg'))
        ->singleFile();
    }

    public function curriculum()
    {
        return $this->belongsTo(Currim::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
   
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
