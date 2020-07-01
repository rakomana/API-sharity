<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Comments extends Model
{
    use UUID;

    protected $table = 'post_has_comments';
    protected $guarded;
    
    public function post()
    {
        return $this->belongsToMany(Post::class);
    }
}
