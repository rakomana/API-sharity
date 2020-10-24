<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;
use App\Traits\UUID;

class Company extends Model implements HasMedia
{
    use UUID, HasMediaTrait;

    protected $guarded;
    protected $table = "companies";
    
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
