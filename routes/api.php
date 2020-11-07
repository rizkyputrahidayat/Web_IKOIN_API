<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::resource('/user', 'User\UserController');
Route::resource('/nasabah', 'Nasabah\NasabahController');
Route::resource('/merchant', 'Merchant\MerchantController');
Route::resource('/tabungan', 'Tabungan\TabunganController');
Route::resource('/merchant', 'Merchant\MerchantController');
Route::resource('/nasabahatm', 'Atm\AtmController');

// API Login Aplikasi Mobile
Route::post('/user/postlogin', [
    'uses' => 'PostController@store'
]);
// API Request OTP
Route::post('/user/sign', [
    'uses' => 'PostController@sign'
]);
// API Login Via ATM
Route::post('/user/signin', [
    'uses' => 'PostController@signin'
]);
// API Setoran via ATM
Route::post('/user/setoran_atm', [
    'uses' => 'Post1Controller@setoran_atm'
]);
// API Setoran via MERCHANT
Route::post('/user/setoran_merchant', [
    'uses' => 'Post1Controller@setoran_merchant'
]);

// API Transfer Via ATM
Route::post('/user/transfer_atm', [
    'uses' => 'Post1Controller@transfer_atm'
]);
// API Transfer Koin Via Mobile
Route::post('/user/transfer_mobile', [
    'uses' => 'Post1Controller@transfer_mobile'
]);
// API cek saldo via mesin ATM
Route::post('/user/cekSaldo_atm', [
    'uses' => 'GetController@cekSaldo_atm'
]);
// API cek saldo via mesin ATM
Route::post('/user/cekSaldo_mobile', [
    'uses' => 'GetController@cekSaldo_mobile'
]);
// API Riwayat Transaksi via mobile
Route::post('/user/riwayat_TransaksiMobile', [
    'uses' => 'GetController@riwayat_TransaksiMobile'
]);
