<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

/**
 * Website routes
 */
Route::get('/features', function () {
    return view('features');
})
    ->name('features');
Auth::routes();

/**
 * Logged users
 */
Route::resource('articles', 'ArticleController');