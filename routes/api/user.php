<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\CurrimController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\CompaniesController;
use App\Http\Controllers\User\FileUserController;
use App\Http\Controllers\User\FileController;
use App\Http\Controllers\User\CompanyUserController;
use App\Http\Controllers\User\PostCommentsController;
use App\Http\Controllers\User\PostLikesController;
use React\HttpClient\Request;

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

Route::prefix('auth')->group(function () {
    Route::post('login',[LoginController::class, 'login']);
    Route::post('register',[RegisterController::class, 'register']);
});

Route::middleware('auth:api_user')->group(function() {
    Route::get('/auth/logout',[LoginController::class, 'logout']);
    Route::get('/',[AccountController::class, 'show']);

    Route::group(['prefix' => 'user'], function () {
        Route::get('/',[AccountController::class, 'show']);
        Route::post('/',[AccountController::class, 'update']);
        Route::delete('/',[AccountController::class, 'destroy']);
        Route::post('password',[AccountController::class, 'updatePassword']);
        Route::post('/profile-picture',[AccountController::class, 'updateProfilePicture']);
    });

    Route::group(['prefix' => 'curriculum'], function () {
        Route::post('/',[CurrimController::class, 'store']);
        Route::get('/',[CurrimController::class, 'show']);
        Route::patch('/',[CurrimController::class, 'update']);
        Route::delete('/',[CurrimController::class, 'deleteVideoCv']);
        Route::post('/video',[CurrimController::class, 'updateVideoCv']);
        Route::delete('/video',[CurrimController::class, 'deleteVideoCv']);
    });

    Route::group(['prefix' => 'company'], function () {
        Route::get('/',[CompaniesController::class, 'show']);
        Route::post('/',[CompaniesController::class, 'store']);
        Route::patch('/',[CompaniesController::class, 'update']);
        Route::delete('/',[CompaniesController::class, 'destroy']);
        Route::post('/documents',[CompaniesController::class, 'storeDocuments']);
        Route::get('/documents',[CompaniesController::class, 'indexDocuments']);
        Route::post('/logo',[CompaniesController::class, 'updateCompanyLogo']);
        Route::get('/logo',[CompaniesController::class, 'indexCompanyLogo']);
    });

    Route::group(['prefix' => 'file'], function () {
        Route::get('/',[FileController::class, 'index']);
        Route::post('/',[FileController::class, 'store']);
        Route::patch('/',[FileController::class, 'update']);
        Route::delete('/',[FileController::class, 'destroy']);
        Route::get('/featured-image',[FileController::class, 'indexFeaturedImage']);
        Route::post('/featured-image',[FileController::class, 'storeFeaturedImage']);
    });

    Route::group(['prefix' => 'file-user'], function () {
        Route::get('/',[FileUserController::class, 'index']);
        Route::get('/{user}',[FileUserController::class, 'show']);
        Route::post('/{user}',[FileUserController::class, 'store']);
        Route::delete('/{user}',[FileUserController::class, 'destroy']);
        //Route::post('/{user}',[FileUserController::class, 'assignRole']);
    });

    Route::prefix('company-user')->group(function () {
        Route::get('/',[CompanyUserController::class, 'index']);
        Route::post('/',[CompanyUserController::class, 'store']);
        Route::get('/{user}',[CompanyUserController::class, 'show']);
        Route::post('/{user}',[CompanyUserController::class, 'update']);
        Route::delete('/{user}',[CompanyUserController::class, 'destroy']);
        //Route::post('/{user}',[CompanyUserController::class, 'assignRole']);
    });
});