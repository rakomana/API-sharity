<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;
use App\Traits\UUID;

class Currim extends Model implements HasMedia
{
    use HasMediaTrait, UUID;

    protected $guarded;

    public function curriculum()
    {
        return $this->belongsTo(Currim::class);
    }
}
