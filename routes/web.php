<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BridgeController;

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

// Middleware login

Route::get('login', 'App\Http\Controllers\AuthController@index');
Route::post('post-login', 'App\Http\Controllers\AuthController@postLogin');
Route::get('dashboard', 'App\Http\Controllers\AuthController@dashboard')->name('show.dashboard');
Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('user.logout');

Route::resource('admin/user', UserController::class)->middleware('is_admin')->names('admin.user');
Route::resource('admin/bridge', BridgeController::class)->names('admin.bridge');

Route::get('admin', 'App\Http\Controllers\AdminController@index')->middleware('is_admin')->name('admin.index');
Route::post('admin/assign', 'App\Http\Controllers\AdminController@assign')->middleware('is_admin')->name('admin.assign');