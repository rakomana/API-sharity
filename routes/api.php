<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\CurrimController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api_user" middleware group. Enjoy building your API!
|
*/

Route::post('user/auth/login',[LoginController::class, 'login']);
Route::post('user/auth/register',[RegisterController::class, 'store']);

Route::middleware('auth:api_user')->group(function() {
    Route::post('curriculum',[CurrimController::class, 'store']);
    Route::get('curriculum',[CurrimController::class, 'show']);
    Route::patch('curriculum',[CurrimController::class, 'update']);
    Route::post('curriculum/video',[CurrimController::class, 'updateVideoCv']);
    Route::delete('curriculum/video',[CurrimController::class, 'deleteVideoCv']);
    Route::delete('curriculum',[CurrimController::class, 'deleteVideoCv']);
});