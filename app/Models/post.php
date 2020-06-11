<?php

namespace App\Models;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use Uuids;
    
     protected $fillable = [
        'user_id','jobTitle', 'companyName','location', 'salary','fullDescription','experience','skills','phoneNumber','email','type'
        ];
        public function user()
        {
            return $this->belongsTo('App\User');
        }
        public function currims()
        {
            return $this->hasMany('App\Models\Currim');
        }
}
