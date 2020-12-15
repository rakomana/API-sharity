<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Generic\CurriculumController;
use React\HttpClient\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These 
| routes are loaded by the RouteServiceProvider within a group. Enjoy building your API!
|
*/

Route::get('generic/user/curriculum', [CurriculumController::class, 'index']);