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
Route::get('/characters/{id}/stats', 'CharacterController@stat_block');
Route::resource('organisations', 'OrganisationController');
Route::resource('locations', 'LocationController');
Route::resource('assets', 'AssetController');

Route::get('/spells/{name}', 'SpellController@view');
Route::get('/spells/{name}/stats', 'SpellController@stat_block');


Route::prefix('api')->group(function () {
    Route::get('characters', 'CharacterController@api_index');
    Route::get('locations', 'LocationController@api_index');
});
