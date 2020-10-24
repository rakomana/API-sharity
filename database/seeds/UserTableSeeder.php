<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $user = new User();
        $user->full_name = 'Oluwagbemiga';
        $user->last_name = 'Ben-Daniel';
        $user->email = 'princerakomana@gmail.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('password');
        $user->remember_token = Str::random(100);
        $user->save();
    }
}