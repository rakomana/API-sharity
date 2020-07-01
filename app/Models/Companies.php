<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Companies extends Model
{
    use UUID;

    protected $guarded;
    
    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
