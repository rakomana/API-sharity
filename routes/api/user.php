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

Route::post('auth/login',[LoginController::class, 'login']);
Route::post('auth/register',[RegisterController::class, 'register']);

Route::middleware('auth:api_user')->group(function() {
    Route::get('/auth/logout',[LoginController::class, 'logout']);

    Route::get('/',[AccountController::class, 'show']);
    Route::post('/',[AccountController::class, 'update']);
    //Route::get('/logs',[AccountController::class, 'logs']);
    Route::delete('/',[AccountController::class, 'destroy']);
    Route::post('/password',[AccountController::class, 'updatePassword']);
    Route::post('/profile-picture',[AccountController::class, 'updateProfilePicture']);

    Route::get('/company',[CompaniesController::class, 'show']);
    Route::post('/company',[CompaniesController::class, 'store']);
    Route::patch('/company',[CompaniesController::class, 'update']);
    Route::delete('/company',[CompaniesController::class, 'destroy']);
    Route::post('/company/documents',[CompaniesController::class, 'storeDocuments']);
    Route::get('/company/documents',[CompaniesController::class, 'indexDocuments']);
    Route::post('/company/logo',[CompaniesController::class, 'updateCompanyLogo']);
    Route::get('/company/logo',[CompaniesController::class, 'indexCompanyLogo']);

    Route::get('/file',[FileController::class, 'index']);
    Route::post('/file',[FileController::class, 'store']);
    Route::patch('/file',[FileController::class, 'update']);
    Route::delete('/file',[FileController::class, 'destroy']);
    Route::get('/file/featured-image',[FileController::class, 'indexFeaturedImage']);
    Route::post('/file/featured-image',[FileController::class, 'storeFeaturedImage']);

    Route::get('/file-user',[FileUserController::class, 'index']);
    Route::get('/file-user/{user}',[FileUserController::class, 'show']);
    Route::post('/file-user/{user}',[FileUserController::class, 'store']);
    Route::delete('/file-user/{user}',[FileUserController::class, 'destroy']);
    //Route::post('/file-user/{user}',[FileUserController::class, 'assignRole']);

    Route::get('/company-user',[CompanyUserController::class, 'index']);
    Route::get('/company-user/{user}',[CompanyUserController::class, 'show']);
    Route::post('/company-user',[CompanyUserController::class, 'store']);
    Route::delete('/company-user/{user}',[CompanyUserController::class, 'destroy']);
    //Route::post('/company-user/{user}',[CompanyUserController::class, 'assignRole']);
    Route::post('/company-user/{user}',[CompanyUserController::class, 'update']);

    Route::post('curriculum',[CurrimController::class, 'store']);
    Route::get('curriculum',[CurrimController::class, 'show']);
    Route::patch('curriculum',[CurrimController::class, 'update']);
    Route::post('curriculum/video',[CurrimController::class, 'updateVideoCv']);
    Route::delete('curriculum/video',[CurrimController::class, 'deleteVideoCv']);
    Route::delete('curriculum',[CurrimController::class, 'deleteVideoCv']);
});