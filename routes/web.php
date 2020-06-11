<?php

use Illuminate\Http\Request;
use App\post;
use Illuminate\Support\Facades\Route;

Route::get('/register2', function () {
    return view('auth.register2');
});
Route::get('/acc1', function () {
    return view('job');
});

Route::get('moredetails', function () {
    return view('single');
});
Route::get('about', function () {
    return view('about');
});
Route::get('Cate', function () {
    return view('category');
});
Route::get('moredetails', function () {
    return view('single');
});
Route::get('/create', function () {
    return view('post.create');
});
Route::get('/contact', function () {
    return view('contact');
});

Auth::routes();

Route::post('contact-us', ['as'=>'contactus.store','uses'=>'ContactUSController@contactUSPost']);

Route::get('details/{id}', 'PostController@details')->name('details');
Route::get('/', 'PostController@show')->name('pete');
Route::get('/home-p', 'PostController@show');
Route::resource('post', 'PostController');
Route::get('/cv', 'CurrimController@show');
Route::get('/app', 'CurrimController@shows');

Route::post('/curriculum', 'currimController@store');
Route::get('/curriculum', 'currimController@show');
Route::post('/curriculum/self', 'currimController@update');
Route::post('/curriculum/video-cv', 'currimController@updateVideoCv');
Route::post('/curriculum/video-cv/remove', 'currimController@destroyVideoCv');
Route::post('/curriculum/self/remove', 'currimController@destroy');