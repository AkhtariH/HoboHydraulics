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
Route::get('login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::post('post-login', 'App\Http\Controllers\AuthController@postLogin');
Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('user.logout');

// Dashboard
Route::get('dashboard', 'App\Http\Controllers\DashboardController@index')->middleware('auth')->name('dashboard');
Route::get('dashboard/bridge/{id}', 'App\Http\Controllers\DashboardController@show')->middleware('auth')->name('dashboard.show');

// Admin Panel
Route::resource('admin/user', UserController::class)->middleware(['auth', 'is_admin'])->names('admin.user');
Route::resource('admin/bridge', BridgeController::class)->middleware(['auth', 'is_admin'])->names('admin.bridge');
Route::get('admin', 'App\Http\Controllers\AdminController@index')->middleware(['auth', 'is_admin'])->name('admin.index');
Route::post('admin/assign', 'App\Http\Controllers\AdminController@assign')->middleware(['auth', 'is_admin'])->name('admin.assign');

// AJAX requests
Route::post('threshold', 'App\Http\Controllers\ThresholdController@threshold')->middleware('auth')->name('threshold');