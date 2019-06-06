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
})->name('home');

/**
 * Website routes
 */
Route::get('/features', function () {
    return view('features');
})
    ->name('features');

// login / register
Auth::routes();

/**
 * Logged users
 */
Route::get('/dashboard', function () {
    return 'Create dashboard';
})->name('dashboard');
Route::get('/relations', 'CharacterController@relations')->name('characters.relations');
Route::resource('articles', 'ArticleController');
Route::resource('characters', 'CharacterController');
Route::resource('organisations', 'OrganisationController');
Route::resource('locations', 'LocationController');
Route::resource('assets', 'AssetController');
