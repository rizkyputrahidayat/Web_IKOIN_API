<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'SiteController@home');
Route::get('/register', 'SiteController@register');
Route::post('/postregister', 'SiteController@postregister');

// Login
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');


Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    // ATM Nasabah
    Route::get('/nasabahatm', 'AtmController@index');
    Route::post('/nasabahatm/create', 'AtmController@create');
    Route::get('/nasabahatm/{id_atm}/edit', 'AtmController@edit');
    Route::post('/nasabahatm/{id_atm}/update', 'AtmController@update');
    Route::get('/nasabahatm/{id_atm}/delete', 'AtmController@delete');
    // Nasabah

    Route::get('/nasabah', 'NasabahController@index');
    Route::post('/nasabah/create', 'NasabahController@create');
    Route::get('/nasabah/{id}/edit', 'NasabahController@edit');
    Route::get('/nasabah/{id}/delete', 'NasabahController@delete');
    Route::post('/nasabah/{id}/update', 'NasabahController@update');
    Route::get('/nasabah/{id}/profile', 'NasabahController@profile');
    // Merchant
    Route::get('/merchant', 'MerchantController@index');
    Route::post('/merchant/create', 'MerchantController@create');
    Route::get('/merchant/{id_merchant}/delete', 'MerchantController@delete');
    // Tabungan
    Route::get('/tabungan', 'TabunganController@index');
    Route::post('/tabungan/create', 'TabunganController@create');
    //Dashboard Controller
});
Route::group(['middleware' => ['auth', 'checkRole:admin,nasabah']], function () {
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/nasabah/{id}/profile', 'NasabahController@profile');
    Route::get('/nasabahatm', 'AtmController@index');
    Route::get('/merchant', 'MerchantController@index');
    Route::get('/nasabah', 'NasabahController@index');
});
