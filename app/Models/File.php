<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class File extends Model
{
    use UUID;

    protected $guarded;
    
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
