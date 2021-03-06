<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;
use App\Traits\UUID;

class File extends Model implements HasMedia
{
    use UUID, HasMediaTrait;

    protected $guarded;

    public $appends = ['url', 'size_in_kb'];

    public function getUrlAttribute()
    {
        return Storage::cloud()->url($this->file);
    }

    public function getSizeInKbAttribute()
    {
        return round($this->size / 1024, 2);
    }
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
