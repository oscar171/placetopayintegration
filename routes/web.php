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
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth', function () {
    return view('welcome');
});

Route::get('/placetopay/callback', function () {
    Log::info('place.requests', ['request' => request()->all()]);
});

Auth::routes();

Route::get('/pay', 'AuthPlaceToPayController@createPay');
Route::get('/placetopay/callback/{ref}', 'AuthPlaceToPayController@callbackHandler');

Route::get('/home', 'HomeController@index')->name('home');
