<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

/**
 * ========================
 * Movie Routes
 * ========================
 */

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/cinema/list', 'CinemaController@viewlist')->name('movie.list');
Route::get('/cinema/edit/{id}', 'CinemaController@EditMovieList')->name('movie.list.edit');
Route::post('/cinema/update/{id}', 'CinemaController@updateMovieList');
Route::get('/cinema/form', 'CinemaController@movieform')->name('movie.form');
Route::post('/cinema/add', 'CinemaController@addNew')->name('movie.add');
Route::get('/cinema/{id}', 'CinemaController@addslots');
Route::post('/cinema/addslot', 'CinemaController@newslot')->name('movie.addslots');
Route::get('/cinema/reserve/{id}','ReservationController@CreateReservation')->name('reservation');
/**
 * Reservation Routes
 */
Route::get('/reservation/list', 'ReservationController@viewlist')->name('reservation.list');
//Route::get('/reservation/list', 'ReservationController@viewlist')->name('reservation.list');
Route::get('/reservation/movie/confrimed/{id}', 'ReservationController@confrimReservation');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
