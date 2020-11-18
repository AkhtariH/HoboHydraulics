<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ThresholdController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BridgeController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\TTNController;


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


Route::get('forgot-password', [PasswordResetController::class, 'index'])->middleware(['guest'])->name('password.request');
Route::post('forgot-password', [PasswordResetController::class, 'email'])->middleware(['guest'])->name('password.email');
Route::get('reset-password/{token}', [PasswordResetController::class, 'reset'])->middleware('guest')->name('password.reset');
Route::post('reset-password', [PasswordResetController::class, 'update'])->middleware('guest')->name('password.update');

// Login
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::get('logout', [AuthController::class, 'logout'])->name('user.logout');

// Dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('dashboard/bridge/{id}', [DashboardController::class, 'show'])->middleware('auth')->name('dashboard.show');

// Profile
Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');

// Admin Panel
Route::resource('admin/user', UserController::class)->middleware(['auth', 'is_admin'])->names('admin.user');
Route::resource('admin/bridge', BridgeController::class)->middleware(['auth', 'is_admin'])->names('admin.bridge');
Route::get('admin', [AdminController::class, 'index'])->middleware(['auth', 'is_admin'])->name('admin.index');
Route::post('admin/assign', [AdminController::class, 'assign'])->middleware(['auth', 'is_admin'])->name('admin.assign');

// AJAX requests
Route::post('threshold', [ThresholdController::class, 'threshold'])->middleware('auth')->name('threshold');

Route::post('fire', [TTNController::class, 'index']);