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
 * Images
 * Return the url to the requested thumbnail
 */
Route::get('/img/{width}/{height}/{filename}', function ($width, $height, $filename) {
    $acceptedSizes = [
        0, 200, 500, 1000, 2000
    ];
    if (!in_array($width, $acceptedSizes)) {
        $width = 200;
    }
    if (!in_array($height, $acceptedSizes)) {
        $height = 200;
    }
    $tmp_filename = md5($width . $height . $filename);
    $path = public_path('cache') . '/';
    // @todo and check cache time...?
    if (is_file($path . $tmp_filename)) {
        return file_get_contents($path . $tmp_filename);
    }
    if (!is_file(public_path() . $filename)) {
        return '';
    }
    $img = Image::make(public_path() . $filename);
    $img->resize($width, $height, function ($constraint) {
        $constraint->aspectRatio();
    });
    if ($img->save($path . $tmp_filename)) {
        return $img->response();
    }
    return '';
})->where('width', '([0-9]+)')
    ->where('height', '([0-9]+)')
    ->where('filename', '.*')
    ->name('thumbnail');

/**
 * Logged users
 */
Route::get('/dashboard', function () {
    return 'Create dashboard';
})->name('dashboard');
Route::resource('articles', 'ArticleController');
Route::resource('characters', 'CharacterController');
Route::resource('organisations', 'OrganisationController');
Route::resource('locations', 'LocationController');
Route::resource('assets', 'AssetController');
