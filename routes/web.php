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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('shop', 'ShopController');
    Route::resource('cart', 'CartController');
    Route::get('toyyibpay', 'ToyyibPayController@createBill');
    Route::get('toyyibpay/paymentStatus', 'ToyyibPayController@paymentStatus')->name('toyyibpay.status');
    Route::post('toyyibpay/callback', 'ToyyibPayController@callback')->name('toyyibpay.callback');
});

require __DIR__ . '/auth.php';
