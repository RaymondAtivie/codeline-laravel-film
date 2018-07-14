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
    return redirect()->route('all_films');
});
Route::get('/films', 'Filmcontroller@all')->name('all_films');
Route::get('/films/{film_slug}', 'Filmcontroller@singleFilm')->name('all_films');
