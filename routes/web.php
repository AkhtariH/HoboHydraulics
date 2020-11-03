<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('login', 'App\Http\Controllers\AuthController@index');
Route::post('post-login', 'App\Http\Controllers\AuthController@postLogin');
Route::get('register', 'App\Http\Controllers\AuthController@register');
Route::post('post-register', 'App\Http\Controllers\AuthController@postRegister');
Route::get('dashboard', 'App\Http\Controllers\AuthController@dashboard')->name('show.dashboard');
Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('user.logout');
Route::get('bridge/{id}', 'App\Http\Controllers\BridgeController@index')->name('show.bridge');
