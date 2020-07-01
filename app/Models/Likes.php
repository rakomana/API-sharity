<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Likes extends Model
{
    use UUID;

    protected $table = 'post_has_likes';
    protected $guarded;
    
    public function post()
    {
        return $this->belongsToMany(Post::class);
    }
}
