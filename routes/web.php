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


Auth::routes();

Route::post('/pay', 'PlaceToPayController@createPayRequest')->name('new.pay');
Route::get('/placetopay/callback/{ref}', 'PlaceToPayController@callbackHandler');

Route::get('/home', 'HomeController@index')->name('home');
