<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Post extends Model
{
    use UUID;

    protected $guarded;
    
    public function company()
    {
        return $this->hasMany(Company::class);
    }

    public function like()
    {
        return $this->hasMany(Likes::class);
    }

    public function comment()
    {
        return $this->hasMany(Comments::class);
    }
}
