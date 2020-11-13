<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ThresholdController;
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
    return redirect()->route('login');
});

// Login
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin']);
Route::get('logout', [AuthController::class, 'logout'])->name('user.logout');

// Dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('dashboard/bridge/{id}', [DashboardController::class, 'show'])->middleware('auth')->name('dashboard.show');

// Profile
Route::get('profile', [ProfileController::class, 'index']);

// Admin Panel
Route::resource('admin/user', UserController::class)->middleware(['auth', 'is_admin'])->names('admin.user');
Route::resource('admin/bridge', BridgeController::class)->middleware(['auth', 'is_admin'])->names('admin.bridge');
Route::get('admin', [AdminController::class, 'index'])->middleware(['auth', 'is_admin'])->name('admin.index');
Route::post('admin/assign', [AdminController::class, 'assign'])->middleware(['auth', 'is_admin'])->name('admin.assign');

// AJAX requests
Route::post('threshold', [ThresholdController::class, 'threshold'])->middleware('auth')->name('threshold');