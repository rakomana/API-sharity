<?php

namespace App\Models;

use App\Traits\UUID;
use Spatie\MediaLibrary\Models\Media as BaseMedia;

/**
 * @property mixed model
 */
class Media extends BaseMedia
{
    use UUID;

    /**
     * Indicates custom attributes to append to model.
     *
     * @var array
     */
    public $appends = ['full_url'];

    /**
     * Gets full URL of the media
     *
     * @return string
     */
    public function getFullUrlAttribute()
    {
        return $this->getFullUrl();
    }
}
