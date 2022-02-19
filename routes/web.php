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


Auth::routes();

Route::get('/', '\App\Http\Controllers\HomeController@index')->name('home');
Route::get('/refreshToken', '\App\Http\Controllers\ApiServiceController@refresh')->name('refresh_token');
Route::post('/apitest', '\App\Http\Controllers\ApiServiceController@send')->name('api_send');
Route::get('api/quotation/{date}', '\App\Http\Controllers\ApiServiceController@response')->name('apiservice');
