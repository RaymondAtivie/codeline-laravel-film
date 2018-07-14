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
})->name("home");

Route::get('/films/create', 'FilmController@create')->name('create_film_form');
Route::post('/films/create', 'FilmController@storeWeb')->name('create_film');

Route::get('/films', 'FilmController@all')->name('all_films');
Route::get('/films/{film_slug}', 'FilmController@singleFilm')->name('single_film');
Route::any('/films/{film_slug}/comment', 'FilmController@addComment')->middleware(['auth'])->name('add_comment');

Auth::routes();

Route::any('/logout', 'HomeController@logout')->name('logout');
Route::get('/home', function () {
    return redirect()->route('all_films');
})->name('home');
