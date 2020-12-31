<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Generic\UserController;
use App\Http\Controllers\Generic\CurriculumController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These 
| routes are loaded by the RouteServiceProvider within a group. Enjoy building your API!
|
*/

Route::get('generic/users', [UserController::class, 'index']);
Route::get('generic/user/{user}', [UserController::class, 'show']);
Route::get('generic/user/curriculum', [CurriculumController::class, 'index']);